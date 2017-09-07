<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable =['name', 'description'];

    /* one to many with posts */
    public function posts(){
        return $this->hasMany('App\Post');
    }

}
