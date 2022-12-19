<?php

namespace App\Models;

use App\Enums\AddressStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    public function scopeEnable($q)
    {
        return $q->where('status', AddressStatus::ENABLE->name);
    }
}
