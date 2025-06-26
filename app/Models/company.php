<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    
    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function benefits()
    {
        return $this->hasMany(Benefit::class);
    }

    public function connections()
    {
        return $this->hasMany(Connection::class);
    }

    public function favoriteStudents()
    {
        return $this->hasMany(CompanyFavoriteStudent::class);
    }

}
