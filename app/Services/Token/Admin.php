<?php

namespace App\Services\Token;

use App\Jwt\Token;

class Admin extends BaseToken
{
    public function make($id)
    {
        return Token::customPayload([$this->payloadId() =>  $id], config('jwt.secret'));
    }

    public function payloadId(): string
    {
        return 'admin_id';
    }
}
