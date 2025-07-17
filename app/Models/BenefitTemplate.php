<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BenefitTemplate extends Model
{
    use HasFactory;

    /**
     * Campos que podem ser preenchidos em massa
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Casts automáticos de datas
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function benefits()
    {
        return $this->hasMany(Benefit::class);
    }
}