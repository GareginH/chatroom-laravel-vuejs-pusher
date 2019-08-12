<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['user_name', 'content', 'chat_id',];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function chat(){
        return $this->belongsTo(Chat::class);
    }
}
