<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Practicum extends Model
{
    use HasFactory;

    public $incrementing = false;

    public static function boot()
    {
        parent::boot();

        static::creating(function ($practicum) {
            $last_practicum = self::orderBy('created_at', 'desc')->first();
            if (!$last_practicum) {
                $practicum->practicum_number = 1;
            } else {
                $practicum_number = explode('-', $last_practicum->practicum_number);
                $practicum_number = end($practicum_number) + 1;
                $practicum->practicum_number = $practicum_number;
            }
        });
    }

    protected $fillable = [
        'id',
        'user_id',
        'license_number',
        'status',
        'is_reviewed',
        'admin_message',

        'location',
        'personnel',
        'practicum_supervisor',
        'assistant',
        'subject',
        'class_supervisor',
        'facility',
        'start_time',
        'end_time',
        'agency_license',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
