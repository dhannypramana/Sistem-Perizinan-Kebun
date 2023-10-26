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
        'signed',
        'signature',
        'nip',
        'footer',
        'license_letterhead_id',
        'license_signature_id',
        'license_footer_image_id',
    ];

    public function letterhead()
    {
        return $this->belongsTo(LicenseLetterhead::class, "license_letterhead_id");
    }

    public function signature()
    {
        return $this->belongsTo(LicenseSignature::class, "license_signature_id");
    }

    public function footer_image()
    {
        return $this->belongsTo(LicenseFooterImage::class, "license_footer_image_id");
    }

    public function license_format_details()
    {
        return $this->hasMany(LicenseFormatDetail::class, "license_format_id");
    }

    public function license_format_services()
    {
        return $this->hasMany(LicenseFormatService::class, "license_format_id");
    }
}
