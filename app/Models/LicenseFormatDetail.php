<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;

class LicenseFormatDetail extends Model
{
    use HasFactory, UUID;

    protected $fillable = [
        'id',
        'type',
        'type_name',
        'info_type',
        'license_format_id',
    ];

    public function license_format()
    {
        return $this->belongsTo(LicenseFormat::class, "license_format_id");
    }
}
