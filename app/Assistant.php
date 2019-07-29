<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assistant extends Model
{
    protected $fillable = ['name', 'lastName','level','fone','rut','verificatorDigit','address'];
    
    public function careers()
    {
        return $this->belongsToMany(Career::class,'assistant_career')->withPivot('active');
    }

    public function postulations()
    {	
    	return $this->hasMany(Postulation::class);
    }

    public function assistantScores()
    {	
    	return $this->hasMany(AssistantScore::class);
    }
    
}
