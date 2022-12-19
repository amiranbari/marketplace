<?php

namespace App\Services\Token;

use App\Jwt\Token;

class Customer implements TokenPayloadInterface
{

    public static function make($id)
    {
        return Token::customPayload(['customer_id'  =>  $id], config('jwt.secret'));
    }
}
