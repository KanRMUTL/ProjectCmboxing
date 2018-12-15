<?php

namespace App\marketing;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Guesthouse extends Model
{
    protected $table = 'guesthouses';
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
        return $this->hasMany('App\marketing\Sale');
    }

    public function scopeForsale($query){
        return $query
               ->where('zone_id','=', Auth::user()->zone_id)
               ->orderBy('name');
    }
}
