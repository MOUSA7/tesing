<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = ['name','lecturer_id','price'];
    public function student(){
        return $this->belongsToMany(Student::class);
    }

    public function lecturer(){
        return $this->belongsTo(lecturer::class);
    }
    //
}
