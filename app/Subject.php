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

    public function assistantScores()
    {	
    	return $this->hasMany(AssistantScore::class);
    }

    public function postulations()
    {	
    	return $this->hasMany(Postulation::class);
    }

    public function phases()
    {
        return $this->belongsToMany(Phase::class)->withPivot('active');;
    }
}
