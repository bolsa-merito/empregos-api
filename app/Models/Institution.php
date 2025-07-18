<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'address_id'];

    public function address()
    {
        return $this->belongsTo(Address::class);
    }
    
    public function certificates()
    {
        return $this->hasMany(Certificate::class);
    }

    public function studyings()
    {
        return $this->hasMany(Studying::class);
    }
}