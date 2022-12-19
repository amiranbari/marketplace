<?php

namespace App\Jwt\Helper;

trait JsonEncoder
{

    public function jsonEncode(array $jsonArray): string
    {
        return (string) json_encode($jsonArray);
    }

    public function jsonDecode(string $json): array
    {
        return (array) json_decode($json, true);
    }
}
