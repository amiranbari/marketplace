<?php

namespace App\Services\Token;

use App\Jwt\Token;

class Seller implements TokenPayloadInterface
{

    public static function make($id)
    {
        return Token::customPayload(['seller_id'  =>  $id], config('jwt.secret'));
    }
}
