<?php

namespace App\Jwt;

use App\Jwt\Exception\ValidateException;
use App\Jwt\Interfaces\Encode;
use App\Jwt\Interfaces\Validator;

/**
 * Core validation class for ensuring a token and its claims are valid.
 */
class Validate
{
    private Parsed $parsed;

    private Encode $encode;

    private Validator $validator;

    public function __construct(Parsed $parsed, Encode $encode, Validator $validator)
    {
        $this->parsed = $parsed;

        $this->encode = $encode;

        $this->validator = $validator;
    }

    public function algorithmNotNone(): Validate
    {
        if ($this->validator->algorithm(strtolower($this->parsed->getAlgorithm()), ['none'])) {
            throw new ValidateException(
                'Algorithm claim should not be none.',
                11
            );
        }

        return $this;
    }

    public function signature(): Validate
    {
        $signature = $this->encode->signature(
            $this->parsed->getHeader(),
            $this->parsed->getPayload()
        );

        if (!$this->validator->signature($signature, $this->parsed->getSignature())) {
            throw new ValidateException('Signature is invalid.', 3);
        }

        return $this;
    }
}
