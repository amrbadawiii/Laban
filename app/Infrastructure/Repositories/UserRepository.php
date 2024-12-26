<?php

namespace App\Infrastructure\Repositories;

use App\Infrastructure\Interfaces\IUserRepository;
use App\Domain\Models\User;

class UserRepository extends BaseRepository implements IUserRepository
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    /**
     * Save or update a user record.
     *
     * @param array $data
     * @param int|null $id
     * @return User
     */
    public function save(array $data, ?int $id = null): User
    {
        if ($id) {
            $user = $this->find($id);
            $user->update($data);
        } else {
            $user = $this->create($data);
        }

        return $user;
    }
}
