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
                    DB::raw('seats.name as seatName'),
                    DB::raw('seats.id as seatId'),
                    DB::raw('tickets.id as ticketId'),
                    DB::raw('tickets.name as ticketName'),
                    DB::raw('tickets.price as price')
                ])
                ->join('tickets', 'seats.ticket_id', '=', 'tickets.id');
    }
}
