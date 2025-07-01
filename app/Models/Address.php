<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Address extends Model
{
    use HasFactory;

    /**
     * Os campos que podem ser preenchidos via mass assignment
     */
    protected $fillable = [
        'state',
        'city',
        'neighborhood',
        'street',
        'number',
    ];

    /**
     * Converte automaticamente os timestamps para instâncias de Carbon
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    
        public function companies()
    {
        return $this->hasMany(Company::class);
    }

        public function institutions()
    {
        return $this->hasMany(Institution::class);
    }
}
