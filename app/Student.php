<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Student extends Model
{
    protected $fillable = ['name','subject_id','address'];

    public function subjects(){
        return $this->hasMany(Subject::class);
    }

    public function scopeName($query){
        return $query->where('subject_id','!=',0);
    }

    public function getNameAttribute($value){
        return $value ? Str::upper($value) : 'Dos not exist';
    }

    public function setNameAttribute($value){
        return $this->attributes['name'] = ucwords($value);
    }
    //
}
