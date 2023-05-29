<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LicenseFormatDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'license_format_id',
        'letterhead',
        'title',
        'footnote',
        'signature',
    ];
}
