<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    public function assistants()
    {
        return $this->belongsToMany(Assistant::class,'assistant_career')->withPivot('active');
    }

    public function faculty()
    {
    	return $this->belongsTo(Faculty::class);
    }
    
}
