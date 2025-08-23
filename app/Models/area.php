<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Area extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

     protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
