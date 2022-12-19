<?php

namespace App\Enums;


enum AddressStatus: string
{
    case ENABLE    = 'enable';
    case DISABLE   = 'disable';

    public static function getAllValues(): array
    {
        return array_column(AddressStatus::cases(), 'value');
    }
}
