<?php

namespace App\Repositories;

interface SellerRepositoryInterface
{
    public function login(string $username, string $password);
}
