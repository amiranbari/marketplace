<?php

namespace App\Jwt\Encoders;


class EncodeHS256Strong extends EncodeHS256
{
    public function __construct(string $secret)
    {
        parent::__construct($secret);
    }
}
