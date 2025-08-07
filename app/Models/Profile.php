<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'name', 'course', 'institution', 'semester', 'period', 'skills', 'image_path'
    ];

    protected $casts = [
        'skills' => 'array',
    ];
}
