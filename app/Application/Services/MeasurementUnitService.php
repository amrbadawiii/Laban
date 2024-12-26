<?php

namespace App\Application\Services;

use App\Application\Interfaces\IMeasurementUnitService;
use App\Application\Models\MeasurementUnit;
use App\Domain\Enums\UserType;
use App\Infrastructure\Interfaces\IMeasurementUnitRepository;
use Illuminate\Support\Facades\Session;

class MeasurementUnitService implements IMeasurementUnitService
{
    protected IMeasurementUnitRepository $repository;

    public function __construct(IMeasurementUnitRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get all measurement units with conditions.
     *
     * @param array $conditions
     * @param array $columns
     * @param array $relations
     * @return array
     */

    public function getAllWoP(array $conditions = [], array $columns = ['*'], array $relations = [])
    {
        $units = $this->repository->allWoP($conditions, $columns, $relations);
        return $units;
    }
    public function getAll(array $conditions = [], array $columns = ['*'], array $relations = [])
    {
        $units = $this->repository->all($conditions, $columns, $relations);
        return $units;
    }

    /**
     * Get a unit by ID with optional relations.
     *
     * @param int $id
     * @param array $relations
     * @return MeasurementUnit
     */
    public function getById(int $id, array $relations = []): MeasurementUnit
    {
        $unit = $this->repository->find($id, ['*'], $relations);

        return $this->mapToApplicationModel($unit);
    }

    /**
     * Create a new unit.
     *
     * @param array $data
     * @return MeasurementUnit
     */
    public function create(array $data): MeasurementUnit
    {
        // Only admin users are allowed to create new units
        if (Session::get('role') !== UserType::Admin->value) {
            abort(403, 'Unauthorized action.');
        }

        $unit = $this->repository->create($data);
        return $this->mapToApplicationModel($unit);
    }

    /**
     * Update an existing unit.
     *
     * @param int $id
     * @param array $data
     * @return MeasurementUnit
     */
    public function update(int $id, array $data): MeasurementUnit
    {
        $unit = $this->repository->find($id);

        // Restrict access for non-admin users
        if (Session::get('role') !== UserType::Admin->value) {
            abort(403, 'Unauthorized action.');
        }

        $updatedUnit = $this->repository->update($id, $data);
        return $this->mapToApplicationModel($updatedUnit);
    }

    /**
     * Delete a unit.
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $unit = $this->repository->find($id);

        // Restrict access for non-admin users
        if (Session::get('role') !== UserType::Admin->value) {
            abort(403, 'Unauthorized action.');
        }

        return $this->repository->delete($id);
    }

    /**
     * Search for units based on criteria.
     *
     * @param array $criteria
     * @param array $columns
     * @param array $relations
     * @return array
     */
    public function search(array $criteria, array $columns = ['*'], array $relations = []): array
    {
        $results = $this->repository->customQuery(function ($query) use ($criteria, $columns, $relations) {
            $query->with($relations);

            foreach ($criteria as $condition) {
                if (is_array($condition) && count($condition) === 3) {
                    [$column, $operator, $value] = $condition;
                    $query->where($column, $operator, $value);
                } elseif (is_array($condition) && count($condition) === 2) {
                    [$column, $value] = $condition;
                    $query->where($column, '=', $value);
                }
            }

            return $query->get($columns);
        });

        return array_map(fn($unit) => $this->mapToApplicationModel($unit)->toArray(), $results->toArray());
    }

    /**
     * Map a repository model to the application model.
     *
     * @param object $model
     * @return MeasurementUnit
     */
    private function mapToApplicationModel($model): MeasurementUnit
    {
        return new MeasurementUnit(
            id: $model->id,
            nameEn: $model->name_en,
            nameAr: $model->name_ar,
            abbreviation: $model->abbreviation
        );
    }
}
