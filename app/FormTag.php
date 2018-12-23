<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormTag extends Model
{
    public function tag(){
        return $this->belongsTo('App\Tag');
    }
    public function form(){
        return $this->belongsTo('App\Form');
    }
}
