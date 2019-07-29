<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssistantScore extends Model
{
    public function assistant()
    {
        return $this->belongsTo(Assistant::class);
    }

    public function postulation()
    {
        return $this->belongsTo(Postulation::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    
    
}
