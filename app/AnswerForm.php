<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnswerForm extends Model
{
    public function form(){
        return $this->belongsTo('App\Form');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function answers(){
        return $this->hasMany('App\Answer');
    }
}
