<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExperienceAndProject extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'student_id'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
