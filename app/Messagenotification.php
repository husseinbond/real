<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Messagenotification extends Model
{
    public function msg(){
        return $this->belongsTo(Message::class, 'message_id');
    }


    public function sender(){
        return $this->belongsTo(User::class, 'sender_id');
    }



}
