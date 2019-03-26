<?php

namespace App\shopping;

use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    protected  $table = 'seats';
    
    public function ticket()
    {
        return $this->belongsTo('App\marketing\Ticket');
    }
}
