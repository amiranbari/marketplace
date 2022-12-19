<?php

namespace App\Services\Token;

use App\Jwt\Token;
use Illuminate\Support\Str;

abstract class BaseToken
{
    public function validate(string $authorization): int
    {
        $token = Str::remove('Bearer ', $authorization);
        $id = optional(Token::getPayload($token))[$this->payloadId()];
        if (!Token::validate($token, config('jwt.secret')) or !isset($id)) abort(403);
        return $id;
    }

    abstract public function make($id);

    abstract public function payloadId(): string;
}
