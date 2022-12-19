<?php

namespace App\Http\Controllers;

use App\Enums\UserTypes;
use App\Http\Requests\LoginRequest;
use App\Repositories\Login\EloquentAdminLoginRepository;
use App\Repositories\Login\EloquentCustomerLoginRepository;
use App\Repositories\Login\EloquentSellerLoginRepository;
use App\Repositories\Login\LoginRepositoryInterface;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        $username = $request->get('username');
        $password = $request->get('password');
        $entity   = $request->get('entity');

        /** @var LoginRepositoryInterface $repository */
        $repository = $this->createRepository(UserTypes::from($entity));
        $token = $repository->login($username, $password);

        return response()->json([
            'token' =>  $token
        ]);

    }

    private function createRepository(UserTypes $userTypes)
    {
        return match ($userTypes){
            UserTypes::Admin    => resolve(EloquentAdminLoginRepository::class),
            UserTypes::Customer => resolve(EloquentCustomerLoginRepository::class),
            UserTypes::Seller   => resolve(EloquentSellerLoginRepository::class)
        };
    }
}
