<?php

namespace App\marketing;

use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    protected $fillable = [
        'zone_id',
        'name',
        'img',
        'latitude',
        'longitude'
    ];

    public function guesthouses()
    {
        return $this->hasMany('App\marketing\Guesthouse');
    }

    public function users()
    {
        return $this->hasMany('App\User');
    }
    
    public function employees()
    {
        return $this->hasMany('App\marketing\Employee');
    }
}
