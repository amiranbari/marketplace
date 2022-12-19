<?php

namespace App\Repositories;

interface CustomerRepositoryInterface
{
    public function login(string $username, string $password);
}
