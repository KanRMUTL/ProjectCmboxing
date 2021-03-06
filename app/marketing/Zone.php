<?php

namespace App\marketing;

use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    protected $fillable = [
        'name',
        'img',
        'latitude',
        'longitude'
    ];
    public $timestamps = false;
    public function guesthouses()
    {
        return $this->hasMany('App\marketing\Guesthouse');
    }
    
    public function employees()
    {
        return $this->hasMany('App\marketing\Employee');
    }

    public function sale()
    {
        return $this->hasMany('App\marketing\Sale', 'zone_id', 'id');
    }
}
