<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = ['id', 'name', 'referenceCoordination'];
    public function requirements()
    {	
    	return $this->hasMany(Requirement::class);
    }

    public function studentScores()
    {	
    	return $this->hasMany(StudentScore::class);
    }

    public function postulations()
    {	
    	return $this->hasMany(Postulation::class);
    }

    public function periods()
    {
        return $this->belongsToMany(Period::class);
    }
}
