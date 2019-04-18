<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public function careers()
    {
        return $this->belongsToMany(Career::class);
    }

    public function postulations()
    {	
    	return $this->hasMany(Postulation::class);
    }

    public function studentScores()
    {	
    	return $this->hasMany(StudentScore::class);
    }
    
}
