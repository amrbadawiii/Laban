<?php

namespace App\Application\Services;

use App\Application\Interfaces\IOrderService;
use App\Infrastructure\Repositories\OrderItemRepository;
use App\Infrastructure\Repositories\OrderRepository;

class OrderService implements IOrderService
{
    protected $orderRepository;
    protected $orderItemRepository;

    public function __construct(
        OrderRepository $orderRepository, // Inject OrderRepository
        OrderItemRepository $orderItemRepository // Inject OrderItemRepository
    ) {
        $this->orderRepository = $orderRepository;
        $this->orderItemRepository = $orderItemRepository;
    }

    public function getAllWoP(array $conditions = [], array $columns = ['*'], array $relations = [])
    {
        return $this->orderRepository->allWoP($conditions, $columns, $relations);
    }

    public function getAll(array $conditions = [], array $columns = ['*'], array $relations = [])
    {
        return $this->orderRepository->all($conditions, $columns, $relations);
    }

    public function getById(int $id, array $relations = [])
    {
        return $this->orderRepository->find($id, ['*'], $relations);
    }

    public function create(array $data): object
    {
        return \DB::transaction(function () use ($data) {
            // Create the order
            $order = $this->orderRepository->create([
                'warehouse_id' => $data['warehouse_id'],
                'customer_id' => $data['customer_id'],
                'order_number' => $data['order_number'],
                'order_date' => $data['order_date'],
                'delivery_date' => $data['delivery_date'] ?? null,
                'order_status' => $data['order_status'] ?? 'pending',
                'total_amount' => $data['total_amount'] ?? 0,
                'notes' => $data['notes'] ?? null,
                'created_by' => $data['created_by'] ?? null,
                'updated_by' => $data['updated_by'] ?? null,
            ]);

            // Create order items
            if (isset($data['items']) && is_array($data['items'])) {
                foreach ($data['items'] as $item) {
                    $item['order_id'] = $order->id; // Add order_id to item data
                }
                $this->orderItemRepository->bulkCreate($data['items']);
            }

            return $order;
        });
    }

    public function update(int $id, array $data): object
    {
        return \DB::transaction(function () use ($id, $data) {
            // Update the order
            $order = $this->orderRepository->update($id, [
                'warehouse_id' => $data['warehouse_id'] ?? null,
                'customer_id' => $data['customer_id'] ?? null,
                'order_number' => $data['order_number'] ?? null,
                'order_date' => $data['order_date'] ?? null,
                'delivery_date' => $data['delivery_date'] ?? null,
                'order_status' => $data['order_status'] ?? null,
                'total_amount' => $data['total_amount'] ?? null,
                'notes' => $data['notes'] ?? null,
                'updated_by' => $data['updated_by'] ?? null,
            ]);

            // Update or replace order items
            if (isset($data['items']) && is_array($data['items'])) {
                // Option 1: Delete old items and insert new ones
                $this->orderItemRepository->bulkDelete(
                    $this->orderItemRepository->allWoP(
                        ['order_id' => $id],
                        ['id']
                    )->pluck('id')->toArray()
                );

                foreach ($data['items'] as $item) {
                    $item['order_id'] = $id; // Add order_id to item data
                }
                $this->orderItemRepository->bulkCreate($data['items']);
            }

            return $order;
        });
    }

    public function delete(int $id): bool
    {
        return \DB::transaction(function () use ($id) {
            // Delete order items
            $this->orderItemRepository->bulkDelete(
                $this->orderItemRepository->allWoP(['order_id' => $id], ['id'])->pluck('id')->toArray()
            );

            // Delete the order
            return $this->orderRepository->delete($id);
        });
    }

    public function search(array $criteria, array $columns = ['*'], array $relations = []): array
    {
        return $this->orderRepository->customQuery(function ($query) use ($criteria) {
            // Apply custom search logic
            foreach ($criteria as $column => $value) {
                $query->where($column, 'like', "%$value%");
            }
            return $query->get();
        });
    }

    public function addOrderItems(int $orderId, array $items): void
    {
        // Prepare items for insertion

        $items['order_id'] = $orderId;
        $items['total_price'] = $items['quantity'] * $items['unit_price'];
        $relations = [];
        $order = $this->orderRepository->find($orderId, ['*'], $relations);
        if (!$order) {
            throw new \Exception("Order record not found.");
        }
        $order->total_amount += $items['quantity'];
        $order->save();
        // Bulk insert items
        $this->orderItemRepository->create($items);
    }

    public function removeOrderItems(int $orderId): void
    {
        $orderItem = $this->orderItemRepository->find($orderId);
        $order = $this->orderRepository->find($orderItem->order_id);
        $order->total_amount -= $orderItem->quantity;
        $order->save();
        // Delete items by IDs
        $this->orderItemRepository->delete($orderId);
    }

    public function updateStatus(int $id, string $status)
    {
        $order = $this->orderRepository->find($id);
        $order->order_status = $status;
        $order->save();

        return $order;
    }

}
