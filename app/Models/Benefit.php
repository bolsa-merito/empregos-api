<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Benefit extends Model
{   
    use HasFactory;

     /**
     * Campos preenchíveis em massa
     */
    protected $fillable = [
        'benefits_template_id',
        'company_id',
        'description',
    ];

    /**
     * Casts automáticos de datas
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    
        public function benefitTemplate()
    {
        return $this->belongsTo(BenefitTemplate::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

}
