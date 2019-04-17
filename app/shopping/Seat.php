<?php

namespace App\shopping;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Auth;

class Seat extends Model
{
    protected  $table = 'seats';
    
    public function seatRegister()
    {
        return $this->hasMany('App\shopping\SeatRegister', 'seat_id', 'id');
    }

    public function ticket()
    {
        return $this->belongsTo('App\marketing\Ticket');
    }

    public function scopeForBooking($query)
    {
        return $query
                ->select([
                    'seats.name as seatName',
                    'seats.id as seatId',
                    'tickets.id as ticketId',
                    'tickets.name as ticketName',
                    'tickets.price as price'
                ])
                ->join('tickets', 'seats.ticket_id', '=', 'tickets.id');
    }
}
