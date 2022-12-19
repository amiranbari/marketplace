<?php

namespace App\Repositories;

use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\UnauthorizedException;

class EloquentAdminLoginRepository implements LoginRepositoryInterface
{

    protected Admin $model;

    public function __construct(Admin $user)
    {
        $this->model = $user;
    }

    public function login(string $username, string $password)
    {
        if (empty($admin = $this->model->where('username', $username)->first())) {
            throw new UnauthorizedException("User or password incorrect.");
        }

        if (!Hash::check($password, $admin->password)){
            throw new UnauthorizedException("User or password incorrect.");
        }

        return \App\Services\Token\Admin::make($admin->id);
    }
}
