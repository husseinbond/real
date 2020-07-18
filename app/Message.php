<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public function fromuser(){
        return $this->hasOne(User::class,'form_user_id');
    }


    public function touser(){
        return $this->hasOne(User::class,'to_user_id');
    }


    protected $fillable = [
        'message', 'to_user_id', 'from_user_id','read'
    ];


}
   
