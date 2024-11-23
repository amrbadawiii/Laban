<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Models\User as DomainUser;
use App\Infrastructure\Interfaces\UserRepositoryInterface;
use App\Infrastructure\Models\User as EloquentUser;
use App\Domain\Enums\UserType;

class UserRepository implements UserRepositoryInterface
{
    public function findById(int $id): ?DomainUser
    {
        $eloquentUser = EloquentUser::find($id);
        return $eloquentUser ? $this->toDomainModel($eloquentUser) : null;
    }

    public function findByEmail(string $email): ?DomainUser
    {
        $eloquentUser = EloquentUser::where('email', $email)->first();
        return $eloquentUser ? $this->toDomainModel($eloquentUser) : null;
    }

    public function save(DomainUser $user): void
    {
        $eloquentUser = $user->getId()
            ? EloquentUser::findOrFail($user->getId())
            : new EloquentUser();

        $eloquentUser->name = $user->getName();
        $eloquentUser->email = $user->getEmail();
        $eloquentUser->password = $user->getPassword();
        $eloquentUser->warehouse_id = $user->getWarehouseId();
        $eloquentUser->user_type = $user->getUserType()->value;

        $eloquentUser->save();
    }

    public function delete(int $id): void
    {
        EloquentUser::destroy($id);
    }

    private function toDomainModel(EloquentUser $eloquentUser): DomainUser
    {
        return new DomainUser(
            id: $eloquentUser->id,
            name: $eloquentUser->name,
            email: $eloquentUser->email,
            password: $eloquentUser->password,
            warehouseId: $eloquentUser->warehouse_id,
            userType: UserType::from($eloquentUser->user_type)
        );
    }
}