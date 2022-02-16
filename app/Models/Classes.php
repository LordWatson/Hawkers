<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// The name "Class" is reserved by PHP so I've had to use the plural here
class Classes extends Model
{
    use HasFactory;

    public function attendees()
    {
        return $this->belongsToMany(User::class, 'class_attendees')->where('type', '=', 'attendee');
        //return $this->hasMany(User::class, 'user_id')->where('type', '=', 'attendee');
    }

    public function instructor()
    {
        return $this->belongsToMany(User::class, 'class_attendees')->where('type', '=', 'instructor');
        //return $this->hasMany(User::class, 'user_id')->where('type', '=', 'instructor');
    }
}
