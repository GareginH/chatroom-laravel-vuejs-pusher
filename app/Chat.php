<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $fillable = [
        'name', 'group',
    ];

    public function users(){
        return $this->belongsToMany(User::class);
    }
    public function messages(){
        return $this->hasMany(Message::class);
    }
}
