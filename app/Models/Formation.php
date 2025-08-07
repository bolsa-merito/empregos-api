<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    use HasFactory;

    protected $fillable = [
        'course',
        'start_date',
        'end_date',
        'institution',
    ];

    public function student()
    {
    }
}
