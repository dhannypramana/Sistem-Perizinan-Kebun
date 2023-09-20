<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    public $incrementing = false;

    public static function boot()
    {
        parent::boot();

        static::creating(function ($loan) {
            $last_loan = self::orderBy('created_at', 'desc')->first();
            if (!$last_loan) {
                $loan->loan_number = 1;
            } else {
                $loan_number = explode('-', $last_loan->loan_number);
                $loan_number = end($loan_number) + 1;
                $loan->loan_number = $loan_number;
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
        'quantity',
        'activity',
        'purpose',
        'start_time',
        'end_time',
        'agency_license',
        'reply'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
