<?php

namespace App\Repositories;

use App\Models\Admin;
use App\Models\Seller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\UnauthorizedException;

class EloquentSellerRepository implements LoginRepositoryInterface
{

    protected Seller $model;

    public function __construct(Seller $user)
    {
        $this->model = $user;
    }

    public function login(string $username, string $password)
    {
        if (empty($seller = $this->model->where('username', $username)->first())) {
            throw new UnauthorizedException("User or password incorrect.");
        }

        if (!Hash::check($password, $seller->password)){
            throw new UnauthorizedException("User or password incorrect.");
        }

        return \App\Services\Token\Seller::make($seller->id);
    }
}
