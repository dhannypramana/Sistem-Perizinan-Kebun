<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;

class LicenseFormat extends Model
{
    use HasFactory, UUID;

    protected $fillable = [
        'id',
        'format_title',
        'letterhead',
        'title',
        'footnote',
        'signature'
    ];
}
