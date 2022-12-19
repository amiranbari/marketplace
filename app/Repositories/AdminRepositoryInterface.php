<?php

namespace App\Repositories;

interface AdminRepositoryInterface
{
    public function login(string $username, string $password);
}
