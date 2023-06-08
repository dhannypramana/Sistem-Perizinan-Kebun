<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;

class LicenseFormat extends Model
{
    use HasFactory, UUID;

    protected $table = "license_formats";

    protected $fillable = [
        'id',
        'format_title',
        'letterhead',
        'title',
        'footnote',
        'signature',
        'license_letterhead_id',
        'license_signature_id',
    ];

    public function letterhead()
    {
        return $this->belongsTo(LicenseLetterhead::class, "license_letterhead_id");
    }

    public function signature()
    {
        return $this->belongsTo(LicenseSignature::class, "license_signature_id");
    }
}
