<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'name'
    ];

    public function users(){
        return $this->hasMany('App\UserTag');
    }
    public function tags(){
        return $this->hasMany('App\FormTag');
    }
}
