<?php

namespace App\Repositories;

interface LoginRepositoryInterface
{
    public function login(string $username, string $password);
}
