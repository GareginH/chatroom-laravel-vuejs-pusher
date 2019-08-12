<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable= [
        'title',
    ];
    public function user(){
        $this->belongsTo(User::class);
    }
    public function profileImage()
    {
        $imagePath = ($this->image) ? $this->image : 'profile/missingImage.png';

        return '/storage/' . $imagePath;
    }
}
