<?php

namespace App\Enums;


enum UserTypes: string
{
    case Customer = 'customer';
    case Seller   = 'seller';
    case Admin    = 'admin';

    public static function getAllValues(): array
    {
        return array_column(UserTypes::cases(), 'value');
    }
}
