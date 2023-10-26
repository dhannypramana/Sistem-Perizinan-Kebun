<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LicenseFooterImage extends Model
{
    use HasFactory, UUID;

    protected $table = 'license_footer_images';

    protected $fillable = [
        'id',
        'footer_image',
    ];

    public function format_template()
    {
        return $this->hasMany(LicenseFormat::class, "license_letterhead_id");
    }
}
