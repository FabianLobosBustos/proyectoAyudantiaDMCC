<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    public function requirements()
    {	
    	return $this->hasMany(Requirement::class);
    }

    public function studentScores()
    {	
    	return $this->hasMany(StudentScore::class);
    }

}
