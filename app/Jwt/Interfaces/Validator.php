<?php

namespace App\Jwt\Interfaces;

/**
 * Interface for Validator classes to allow developers to implement custom token
 * validation if required.
 */
interface Validator
{
    public function signature(string $generatedSignature, string $tokenSignature): bool;

    public function algorithm(string $algorithm, array $validAlgorithms): bool;
}
