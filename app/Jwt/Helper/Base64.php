<?php

namespace App\Jwt\Helper;

trait Base64
{

    public function toBase64Url(string $base64): string
    {
        return str_replace(['+', '/', '='], ['-', '_', ''], $base64);
    }


    public function toBase64(string $urlString): string
    {
        return str_replace(['-', '_'], ['+', '/'], $urlString);
    }


    public function addPadding(string $base64String): string
    {
        if (strlen($base64String) % 4 !== 0) {
            return $this->addPadding($base64String . '=');
        }

        return $base64String;
    }
}
