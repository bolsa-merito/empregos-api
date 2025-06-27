<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Certificate extends Model
{
    use HasFactory;

    /**
     * Campos preenchíveis em massa
     */
    protected $fillable = [
        'student_id',
        'institution_id',
        'course_name',
        'course_load',
    ];

    /**
     * Casts automáticos de datas
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Um certificado pertence a um aluno
     */
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    /**
     * Um certificado pertence a uma instituição
     */
    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }
}
