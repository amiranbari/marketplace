<?php

namespace App\Jwt;

use App\Jwt\Interfaces\Encode;
use App\Jwt\Interfaces\Validator;

class Build
{

    private string $type;


    private array $header = [];


    private array $payload = [];


    private Validator $validator;


    private Encode $encode;

    public function __construct(string $type, Validator $validator, Encode $encode)
    {
        $this->type = $type;

        $this->validator = $validator;

        $this->encode = $encode;
    }


    public function setContentType(string $contentType): Build
    {
        $this->header['cty'] = $contentType;

        return $this;
    }

    public function getHeader(): array
    {
        return array_merge(
            $this->header,
            ['alg' => $this->encode->getAlgorithm(), 'typ' => $this->type]
        );
    }


    public function setPayloadClaim(string $key, mixed $value): Build
    {
        $this->payload[$key] = $value;

        return $this;
    }


    public function getPayload(): array
    {
        return $this->payload;
    }


    public function build(): Jwt
    {
        return new Jwt(
            $this->encode->encode($this->getHeader()) . "." .
            $this->encode->encode($this->getPayload()) . "." .
            $this->getSignature()
        );
    }


    private function getSignature(): string
    {
        return $this->encode->signature(
            $this->getHeader(),
            $this->getPayload()
        );
    }
}
