<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Postulation extends Model
{
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function period()
    {
        return $this->belongsTo(Period::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subjects::class);
    }

    public function studentScores()
    {
        return $this->hasMany(StudentScore::class);
    }

}
