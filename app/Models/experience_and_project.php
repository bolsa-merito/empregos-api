<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class experience_and_project extends Model
{
    public function students()
    {
        return $this->hasMany(student::class);
    }
}
