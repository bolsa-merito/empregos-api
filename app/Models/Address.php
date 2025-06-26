<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    
        public function companies()
    {
        return $this->hasMany(Company::class);
    }

        public function institutions()
    {
        return $this->hasMany(Institution::class);
    }
}
