<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['name', 'lastName','level','fone','rut','verificatorDigit','address'];
    
    public function careers()
    {
        return $this->belongsToMany(Career::class,'student_career');
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
