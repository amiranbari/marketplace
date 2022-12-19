<?php

namespace App\Repositories\Login;

interface LoginRepositoryInterface
{
    public function login(string $username, string $password);
}
