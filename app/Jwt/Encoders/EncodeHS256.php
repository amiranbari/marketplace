<?php

namespace App\Jwt\Encoders;

use App\Jwt\Interfaces\Encode;
use App\Jwt\Helper\JsonEncoder;
use App\Jwt\Helper\Base64;


class EncodeHS256 implements Encode
{
    use JsonEncoder;
    use Base64;

    private const ALGORITHM = 'HS256';


    private const HASH_ALGORITHM = 'sha256';

    private string $secret;

    public function __construct(string $secret)
    {
        $this->secret = $secret;
    }


    public function getAlgorithm(): string
    {
        return self::ALGORITHM;
    }


    private function getHashAlgorithm(): string
    {
        return self::HASH_ALGORITHM;
    }

    private function urlEncode(string $toEncode): string
    {
        return $this->toBase64Url(base64_encode($toEncode));
    }


    public function encode(array $toEncode): string
    {
        return $this->urlEncode($this->jsonEncode($toEncode));
    }


    public function signature(array $header, array $payload): string
    {
        return $this->urlEncode(
            $this->hash(
                $this->getHashAlgorithm(),
                $this->encode($header) . "." . $this->encode($payload),
                $this->secret
            )
        );
    }

    private function hash(string $algorithm, string $toHash, string $secret): string
    {
        return hash_hmac($algorithm, $toHash, $secret, true);
    }
}
