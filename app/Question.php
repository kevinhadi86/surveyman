<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    public function form(){
        return $this->belongsTo('App\Form');
    }
    public function options(){
        return $this->hasMany('App\QuestionOption');
    }
    public function answers(){
        return $this->hasMany('App\Answer');
    }
}
