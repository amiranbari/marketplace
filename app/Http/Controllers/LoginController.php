<?php

namespace App\Http\Controllers;

use App\Enums\UserTypes;
use App\Http\Requests\LoginRequest;
use App\Repositories\EloquentAdminRepository;
use App\Repositories\EloquentCustomerRepository;
use App\Repositories\EloquentSellerRepository;
use App\Repositories\LoginRepositoryInterface;
use Illuminate\Support\Facades\Auth;

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
            UserTypes::Admin    => resolve(EloquentAdminRepository::class),
            UserTypes::Customer => resolve(EloquentCustomerRepository::class),
            UserTypes::Seller   => resolve(EloquentSellerRepository::class)
        };
    }
}
