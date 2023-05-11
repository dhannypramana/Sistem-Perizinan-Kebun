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

    public function penelitian()
    {
        return $this->hasMany(Penelitian::class, 'user_id');
    }

    public function data()
    {
        return $this->hasMany(Data::class, 'user_id');
    }

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'user_id');
    }

    public function praktikum()
    {
        return $this->hasMany(Praktikum::class, 'user_id');
    }
}
