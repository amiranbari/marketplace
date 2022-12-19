<?php

namespace App\Repositories;

use App\Models\Role;

class EloquentAdminRepository implements AdminRepositoryInterface
{

    protected Role $model;

    public function __construct(Role $user)
    {
        $this->model = $user;
    }

    public function login(string $username, string $password)
    {

    }
}
