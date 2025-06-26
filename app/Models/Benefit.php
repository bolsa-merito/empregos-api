<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Benefit extends Model
{   
    use HasFactory;
    
        public function benefitTemplate()
    {
        return $this->belongsTo(BenefitsTemplate::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

}
