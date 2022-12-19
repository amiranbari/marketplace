<?php

namespace App\Jwt;

class Parsed
{

    private Jwt $jwt;

    private array $header;

    private array $payload;

    private string $signature;


    public function __construct(Jwt $jwt, array $header, array $payload, string $signature)
    {
        $this->jwt = $jwt;

        $this->header = $header;

        $this->payload = $payload;

        $this->signature = $signature;
    }

    public function getHeaderClaim(string $claim): mixed
    {
        return $this->header[$claim];
    }


    public function getHeader(): array
    {
        return $this->header;
    }


    public function getAlgorithm(): string
    {
        return $this->getHeaderClaim('alg');
    }

    public function getPayload(): array
    {
        return $this->payload;
    }

    public function getSignature(): string
    {
        return $this->signature;
    }
}
