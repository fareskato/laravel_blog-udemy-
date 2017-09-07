<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // <-- This is required
use Carbon;

class Post extends Model
{
    /* soft delete */
    use SoftDeletes;
    protected $dates = ['deleted_at', 'created_at'];

    /* Mass Assignment */
    protected $fillable = ['title', 'content', 'featured', 'category_id', 'slug', 'user_id'];

    /* one to many with categories */
    public function category(){
        return $this->belongsTo('App\Category');
    }

    /*  create accessor*/
    public function getFeaturedAttribute($ftd){
        return asset($ftd);
    }

    /* many to many with tags */
    public function tags(){
        return $this->belongsToMany('App\Tag');
    }

    /* one to many with user */
    public function user(){
        return $this->belongsTo('App\User');
    }



}
