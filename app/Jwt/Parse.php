<?php

namespace App\Jwt;

use App\Jwt\Interfaces\Decode;


class Parse
{

    private Jwt $jwt;


    private Decode $decode;

    public function __construct(Jwt $jwt, Decode $decode)
    {
        $this->jwt = $jwt;

        $this->decode = $decode;
    }


    public function parse(): Parsed
    {
        return new Parsed(
            $this->jwt,
            $this->getDecodedHeader(),
            $this->getDecodedPayload(),
            $this->getSignature()
        );
    }


    private function splitToken(): array
    {
        return explode('.', $this->jwt->getToken());
    }


    private function getHeader(): string
    {
        return $this->splitToken()[0] ?? '';
    }


    private function getPayload(): string
    {
        return $this->splitToken()[1] ?? '';
    }


    public function getSignature(): string
    {
        return $this->splitToken()[2] ?? '';
    }


    public function getDecodedHeader(): array
    {
        return $this->decode->decode(
            $this->getHeader()
        );
    }


    public function getDecodedPayload(): array
    {
        return $this->decode->decode(
            $this->getPayload()
        );
    }
}
