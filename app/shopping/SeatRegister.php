<?php

namespace App\shopping;

use Illuminate\Database\Eloquent\Model;

class SeatRegister extends Model
{
    protected $table = 'seat_registers';
    protected $fillable = ['visit', 'sale_ticket_id', 'seat_id'];
    public $timestamps = false;

    public function seat()
    {
        return $this->belongsTo('App\shopping\Seat');
    }

    public function scopeCheckVisit($query, $seatId, $date)
    {
        return $query ->where([
                    ['visit', $date],
                    ['seat_id', '=', $seatId]
                ])
                ->count();
    }
}


