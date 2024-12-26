<?php

namespace App\Application\Services;

use App\Application\Interfaces\IUserService;
use App\Application\Models\User;
use App\Domain\Enums\UserType;
use App\Infrastructure\Interfaces\IUserRepository;
use Illuminate\Support\Facades\Session;

class UserService implements IUserService
{
    protected IUserRepository $userRepository;

    public function __construct(IUserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAllWoP(array $conditions = [], array $columns = ['*'], array $relations = [])
    {
        $users = $this->userRepository->allWoP($conditions, $columns, $relations);

        return $users;
    }

    public function getAll(array $conditions = [], array $columns = ['*'], array $relations = [])
    {
        // If non-admin, limit users to the current session's warehouse
        if (Session::get('role') !== UserType::Admin->value) {
            $conditions[] = ['id', Session::get('user_id')];
        }
        $users = $this->userRepository->all($conditions, $columns, $relations);

        return $users;
    }

    public function getById(int $id, array $relations = []): User
    {
        $relations = array_merge($relations, ['warehouse']);
        $user = $this->userRepository->find($id, ['*'], $relations);

        // If non-admin, ensure the user belongs to the session's warehouse
        if (Session::get('role') !== UserType::Admin->value && $user->warehouse_id !== Session::get('warehouse_id')) {
            abort(403, 'Unauthorized action.');
        }

        return $this->toApplicationModel($user);
    }

    public function create(array $data): User
    {
        // If non-admin, restrict the creation of users to the current session's warehouse
        if (Session::get('role') !== UserType::Admin->value) {
            $data['warehouse_id'] = Session::get('warehouse_id');
        }

        $savedUser = $this->userRepository->save($data);

        return $this->toApplicationModel($savedUser);
    }

    public function createUser(array $data): User
    {
        return $this->create($data);
    }

    public function update(int $id, array $data): User
    {
        $user = $this->userRepository->find($id);

        // If non-admin, ensure the user belongs to the session's warehouse
        if (Session::get('role') !== UserType::Admin->value && $user->warehouse_id !== Session::get('warehouse_id')) {
            abort(403, 'Unauthorized action.');
        }

        $updatedUser = $this->userRepository->update($id, $data);

        return $this->toApplicationModel($updatedUser);
    }

    public function updateUser(int $id, array $data): User
    {
        return $this->update($id, $data);
    }

    public function delete(int $id): bool
    {
        $user = $this->userRepository->find($id);

        // If non-admin, ensure the user belongs to the session's warehouse
        if (Session::get('role') !== UserType::Admin->value && $user->warehouse_id !== Session::get('warehouse_id')) {
            abort(403, 'Unauthorized action.');
        }

        return $this->userRepository->delete($id);
    }

    public function search(array $criteria, array $columns = ['*'], array $relations = []): array
    {
        if (Session::get('role') !== UserType::Admin->value) {
            $criteria['warehouse_id'] = Session::get('warehouse_id');
        }

        $users = $this->userRepository->customQuery(function ($query) use ($criteria, $relations) {
            foreach ($criteria as $key => $value) {
                $query->where($key, $value);
            }

            $query->with($relations);

            return $query;
        });

        return $users->get()->map(fn($user) => $this->toApplicationModel($user));
    }

    public function getUsersByWarehouse(int $warehouseId, array $columns = ['*'], array $relations = []): array
    {
        $users = $this->userRepository->all(
            ['warehouse_id' => $warehouseId],
            $columns,
            $relations
        );

        return $users->map(fn($user) => $this->toApplicationModel($user));
    }

    private function toApplicationModel($eloquentModel): User
    {
        return new User(
            id: $eloquentModel->id,
            name: $eloquentModel->name,
            email: $eloquentModel->email,
            password: $eloquentModel->password,
            warehouseId: $eloquentModel->warehouse_id,
            userType: UserType::from($eloquentModel->user_type),
            warehouse: $eloquentModel->warehouse,
        );
    }
}
