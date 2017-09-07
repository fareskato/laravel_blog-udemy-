<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /* Mass Assignment */
    protected $fillable = ['tag'];

    /* many to many with posts */
    public function posts(){
        return $this->belongsToMany('App\Post');
    }
}
