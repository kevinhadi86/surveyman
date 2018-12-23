<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserTag extends Model
{
    public function users(){
        return $this->belongsTo('App\User');
    }
    public function tags(){
        return $this->belongsTo('App\Tag');
    }
}
