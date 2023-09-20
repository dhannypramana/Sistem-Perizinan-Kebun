<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Research extends Model
{
    use HasFactory, UUID;

    public $incrementing = false;

    public static function boot()
    {
        parent::boot();

        static::creating(function ($research) {
            $last_research = self::orderBy('created_at', 'desc')->first();
            if (!$last_research) {
                $research->research_number = 1;
            } else {
                $research_number = explode('-', $last_research->research_number);
                $research_number = end($research_number) + 1;
                $research->research_number = $research_number;
            }
        });
    }

    protected $fillable = [
        'id',
        'user_id',
        'license_number',
        'status',
        'admin_message',
        'is_reviewed',

        'location',
        'personnel',
        'title',
        'start_time',
        'end_time',
        'facility',
        'research_supervisor',
        'academic_supervisor',
        'agency_license',
        'reply'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
