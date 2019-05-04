<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    public function careers()
    {	
    	return $this->hasMany(Career::class);
    }
}
