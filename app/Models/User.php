<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, UUID;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'student_number',
        'address',
        'phone_number',
        'academic_program',
        'is_admin',
        'photo',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function research()
    {
        return $this->hasMany(Research::class, 'user_id');
    }

    public function data_request()
    {
        return $this->hasMany(DataRequest::class, 'user_id');
    }

    public function loan()
    {
        return $this->hasMany(Loan::class, 'user_id');
    }

    public function practicum()
    {
        return $this->hasMany(Practicum::class, 'user_id');
    }
}
