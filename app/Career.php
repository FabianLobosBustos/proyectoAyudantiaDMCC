<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    public function students()
    {
        return $this->belongsToMany(Student::class,'student_career')->withPivot('active');
    }

    public function faculty()
    {
    	return $this->belongsTo(Faculty::class);
    }
    
}
