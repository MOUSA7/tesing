<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    protected $fillable=['path','post_id'];

    public function post(){
        return $this->belongsTo(Image::class);
    }

    public function imageable(){
        return $this->morphTo();
    }

    public function url(){
        return ('/storage/'.$this->path);
    }
    //
}
