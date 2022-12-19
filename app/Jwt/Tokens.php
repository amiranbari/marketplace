<?php

namespace App\Jwt;

use App\Jwt\Encoders\EncodeHS256;
use App\Jwt\Encoders\EncodeHS256Strong;
use App\Jwt\Exception\ValidateException;
use App\Jwt\Helper\Validator;

/**
 * Core factory and interface class for creating basic JSON Web Tokens.
 */
class Tokens
{

    public function builder(string $secret): Build
    {
        return new Build(
            'JWT',
            new Validator(),
            new EncodeHS256Strong($secret)
        );
    }

    public function parser(string $token): Parse
    {
        return new Parse(
            new Jwt($token),
            new Decode()
        );
    }

    public function validator(string $token, string $secret = ''): Validate
    {
        return new Validate(
            $this->parser($token)->parse(),
            new EncodeHS256($secret),
            new Validator()
        );
    }


    public function getPayload(string $token): array
    {
        $parser = $this->parser($token);
        return $parser->parse()->getPayload();
    }

    public function customPayload(array $payload, string $secret): Jwt
    {
        $builder = $this->builder($secret);

        foreach ($payload as $key => $value) {
            $builder->setPayloadClaim($key, $value);
        }

        return $builder->build();
    }


    public function validate(string $token, string $secret): bool
    {
        try {
            $validate = $this->validator($token, $secret);
            $validate->algorithmNotNone()
                ->signature();
            return true;
        } catch (ValidateException $e) {
            return false;
        }
    }
}
