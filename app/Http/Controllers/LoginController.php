<?php

namespace App\Http\Controllers;

use App\Enums\UserTypes;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        $username = $request->get('username');
        $password = $request->get('password');
        $entity   = $request->get('entity');
        dd($this->createRepository(UserTypes::from($entity)));
    }

    private function createRepository(UserTypes $userTypes)
    {
//        return match ($userTypes){
//
//        };
    }
}
