<?php

namespace App\Services\Token;

interface TokenPayloadInterface
{
    public static function make($id);
}
