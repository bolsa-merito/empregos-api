<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class studying extends Model
{
    use HasFactory;
    
        public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }

}
