<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Connection extends Model
{
    use HasFactory;

    /**
     * Campos preenchíveis em massa
     */
    protected $fillable = [
        'student_id',
        'company_id',
        'status',
    ];

    /**
     * Casts automáticos de datas
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * A conexão pertence a um estudante
     */
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    /**
     * A conexão pertence a uma empresa
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
