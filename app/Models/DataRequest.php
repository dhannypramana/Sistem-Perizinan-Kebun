<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataRequest extends Model
{
    use HasFactory;

    public $incrementing = false;

    public static function boot()
    {
        parent::boot();

        static::creating(function ($data) {
            $last_data = self::orderBy('created_at', 'desc')->first();
            if (!$last_data) {
                $data->data_number = 1;
            } else {
                $data_number = explode('-', $last_data->data_number);
                $data_number = end($data_number) + 1;
                $data->data_number = $data_number;
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

        'category',
        'title',
        'purpose',
        'agency',
        'agency_license',
        'reply'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
