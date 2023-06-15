<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;

class LicenseFormatService extends Model
{
    use HasFactory, UUID;

    protected $fillable = [
        'id',
        'type',
        'type_name',
        'service',
    ];
}
