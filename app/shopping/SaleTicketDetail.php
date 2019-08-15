<?php

namespace App\shopping;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SaleTicketDetail extends Model
{
    protected $table = "sale_ticket_details";
    protected $fillable = ['amount', 'total', 'ticket_id', 'sale_ticket_id'];
    public $timestamps = false;

    public function saleTicket()
    {
        return $this->belongsTo('App\shopping\SaleTicket');
    }

    public function ticket()
    {
        return $this->belongsTo('App\marketing\Ticket');
    }

    public function scopeMyTicket($query, $saleTicketId)
    {
        return $query   
                ->select(
                    'amount',
                    'tickets.name as name'
                )
                ->join('tickets', 'sale_ticket_details.ticket_id', '=', 'tickets.id')
                ->where('sale_ticket_id', '=', $saleTicketId);
    }
}
