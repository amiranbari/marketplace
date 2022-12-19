<?php

namespace App\Jwt\Helper;

use App\Jwt\Interfaces\Validator as ValidatorInterface;

class Validator implements ValidatorInterface
{
    public function signature(string $generatedSignature, string $tokenSignature): bool
    {
        return hash_equals($generatedSignature, $tokenSignature);
    }

    public function algorithm(string $algorithm, array $validAlgorithms): bool
    {
        return in_array($algorithm, $validAlgorithms);
    }
}
