<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class posts extends Model
{
   
    public function user(){
        return $this->belongsTo(user::class);
    }




    public function comment(){
        return $this->hasMany(comment::class,'post_id');
    }

}
