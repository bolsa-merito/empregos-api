<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyFavoriteStudent extends Model
{
    use HasFactory;
    
        public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

}
