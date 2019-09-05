<?php

namespace App\shopping;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SeatRegister extends Model
{
    protected $table = 'seat_registers';
    protected $fillable = ['visit', 'sale_ticket_id', 'seat_id'];
    public $timestamps = false;

    public function seat()
    {
        return $this->belongsTo('App\shopping\Seat');
    }
    
    public function SaleTicket()
    {
        return $this->belongsTo('App\shopping\SaleTicket');
    }

    public function scopeCheckVisit($query, $seatId, $date)
    {
        return $query ->where([
                    ['visit', $date],
                    ['seat_id', '=', $seatId]
                ])
                ->count();
    }

    public function scopeRegisterDetail($query, $sale_ticket_detail)
    {
        return $query 
                ->select(
                    'seat_registers.visit',
                    'seats.name as seatName',
                    'tickets.id as ticketId',
                    'tickets.name as ticketName'
                )
                ->join('sale_tickets', 'seat_registers.sale_ticket_id', '=', 'sale_tickets.id')
                ->join('seats', 'seat_registers.seat_id', '=', 'seats.id')
                ->join('tickets', 'seats.ticket_id', '=', 'tickets.id')
                ->where([
                    ['sale_ticket_id', '=', $sale_ticket_detail]
                ]);
    }
}


