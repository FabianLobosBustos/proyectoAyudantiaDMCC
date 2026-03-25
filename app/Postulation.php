<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Postulation extends Model
{
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function studentScores()
    {
        return $this->hasMany(StudentScore::class);
    }

}
