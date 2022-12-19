<?php

namespace App\Repositories\Login;

use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\UnauthorizedException;

class EloquentCustomerLoginRepository implements LoginRepositoryInterface
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

        return (new \App\Services\Token\Customer)->make($customer->id);
    }
}
