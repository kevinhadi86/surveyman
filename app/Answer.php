<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable =['answer'];
    public function answerform(){
        return $this->belongsTo('App\AnswerForm');
    }
    public function question(){
        return $this->belongsTo('App\Question');
    }
}
