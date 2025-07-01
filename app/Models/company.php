<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Model
{
    use HasFactory;

    /**
     * Campos preenchíveis em massa
     */
    protected $fillable = [
        'address_id',
        'user_id',
        'name',
        'description',
    ];

    /**
     * Casts automáticos de datas
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    
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
