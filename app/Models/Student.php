<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'birth_date',
        'looking_for_internship',
        'description',
        'contact_email',
        'phone_number',
        'user_id',
    ];

    protected $casts = [
        'birth_date' => 'date',
        'looking_for_internship' => 'boolean',
    ];

    public function experience_and_project()
    {
        return $this->hasMany(ExperienceAndProject::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function studyings()
    {
        return $this->hasMany(Studying::class);
    }

    public function certificates()
    {
        return $this->hasMany(Certificate::class);
    }

    public function connections()
    {
        return $this->hasMany(Connection::class);
    }
}
