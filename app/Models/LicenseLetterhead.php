<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LicenseLetterhead extends Model
{
    use HasFactory, UUID;

    protected $table = 'license_letterheads';

    protected $fillable = [
        'id',
        'letterhead',
    ];

    public function format_template()
    {
        return $this->hasMany(LicenseFormat::class, "license_letterhead_id");
    }
}
