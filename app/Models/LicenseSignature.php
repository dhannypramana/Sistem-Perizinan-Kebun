<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LicenseSignature extends Model
{
    use HasFactory, UUID;

    protected $table = 'license_signatures';

    protected $fillable = [
        'id',
        'signature',
        'license_format_id'
    ];

    public function format_template()
    {
        return $this->hasMany(LicenseFormat::class, "license_signature_id");
    }
}
