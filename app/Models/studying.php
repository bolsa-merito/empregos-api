<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Studying extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'course_id',
        'institution_id',
        'beginning',
        'end',
        'semester',
        'period'
    ];

    protected $casts = [
        'beginning' => 'date',
        'end' => 'date'
    ];
    
    protected $fillable = [
        'student_id',
        'course_id',
        'institution_id',
        'beginning',
        'end',
        'semester',
        'period'
    ];

    protected $casts = [
        'beginning' => 'date',
        'end' => 'date'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }
}