<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;

class Faculty extends Model
{
    use HasFactory, UUID;

    protected $fillable = [
        'id',
        'faculty'
    ];

    public function academic_program()
    {
        return $this->hasMany(AcademicProgram::class, 'faculty_id');
    }
}
