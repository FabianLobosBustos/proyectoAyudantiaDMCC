<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    public function postulations()
    {	
    	return $this->hasMany(Postulation::class);
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class);
    }


}
