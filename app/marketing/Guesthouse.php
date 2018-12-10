<?php

namespace App\marketing;

use Illuminate\Database\Eloquent\Model;

class Guesthouse extends Model
{
    protected $fillable = [
        'name',
        'zone_id'
    ];

    public function zone()
    {
        return $this->belongsTo('App\marketing\Zone');
    }

    public function sales()
    {
        return $this->hasMany('App\market\Sale');
    }
}
