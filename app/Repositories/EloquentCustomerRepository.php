<?php

namespace App\Repositories;

use App\Models\Admin;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\UnauthorizedException;

class EloquentCustomerRepository implements LoginRepositoryInterface
{

    protected Customer $model;

    public function __construct(Customer $user)
    {
        $this->model = $user;
    }

    public function login(string $username, string $password)
    {
        if (empty($customer = $this->model->where('username', $username)->first())) {
            throw new UnauthorizedException("User or password incorrect.");
        }

        if (!Hash::check($password, $customer->password)){
            throw new UnauthorizedException("User or password incorrect.");
        }

        return \App\Services\Token\Customer::make($customer->id);
    }
}
