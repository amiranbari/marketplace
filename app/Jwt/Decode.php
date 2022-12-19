<?php

namespace App\Jwt;
use App\Jwt\Interfaces\Decode as DecodeInterface;
use App\Jwt\Helper\Base64;
use App\Jwt\Helper\JsonEncoder;

class Decode implements DecodeInterface
{
    use Base64;
    use JsonEncoder;

    private function urlDecode(string $toDecode): string
    {
        return (string) base64_decode(
            $this->addPadding($this->toBase64($toDecode)),
            true
        );
    }

    public function decode(string $toDecode): array
    {
        return $this->jsonDecode($this->urlDecode($toDecode));
    }
}
