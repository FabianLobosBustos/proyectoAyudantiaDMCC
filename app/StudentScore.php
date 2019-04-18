<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentScore extends Model
{
    public function student()
    {
        return $this->belongsTo(Student::class);
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
