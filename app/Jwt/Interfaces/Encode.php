<?php

namespace App\Jwt\Interfaces;

/**
 * Interface for Encode classes, enables custom signature encoding dependent
 * on security requirements.
 */
interface Encode
{
    public function getAlgorithm(): string;

    public function encode(array $toEncode): string;

    public function signature(array $header, array $payload): string;
}
