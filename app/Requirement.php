<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requirement extends Model
{
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
