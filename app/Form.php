<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function questions(){
        return $this->hasMany('App\Question');
    }
    public function tag(){
        return $this->hasOne('App\FormTag');
    }
    public function answerforms(){
        return $this->hasMany('App\AnswerForm');
    }
}
