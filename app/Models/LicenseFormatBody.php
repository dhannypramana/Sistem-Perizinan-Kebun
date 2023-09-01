<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\UUID;
use Illuminate\Database\Eloquent\Model;

class LicenseFormatBody extends Model
{
    use HasFactory, UUID;

    protected $fillable = [
        'id',
        'body',
        'license_number',
        'license_format_id'
    ];
}
