<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class comment extends Model
{

    protected $with = ['user'];



    public function user(){
        return $this->belongsTo(user::class);
    }
    
}
