<?php

namespace App\Jwt;

class Token
{
    public static function customPayload(array $payload, string $secret): string
    {
        $tokens = new Tokens();
        return $tokens->customPayload($payload, $secret)->getToken();
    }

    public static function validate(string $token, string $secret): bool
    {
        $tokens = new Tokens();
        return $tokens->validate($token, $secret);
    }

    public static function getPayload(string $token): array
    {
        $tokens = new Tokens();
        return $tokens->getPayload($token);
    }
}
