<?php

namespace App\Services\Token;

use App\Jwt\Token;

class Admin implements TokenPayloadInterface
{

    public static function make($id)
    {
        return Token::customPayload(['admin_id'  =>  $id], config('jwt.secret'));
    }
}
