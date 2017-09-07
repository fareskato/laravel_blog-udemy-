<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = ['avatar','about','user_id','facebook','youtube'];

    /* one to one with user */

    public function user(){
        return $this->belongsTo('App\User');
    }
}
