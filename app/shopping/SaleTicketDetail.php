<?php

namespace App\shopping;

use Illuminate\Database\Eloquent\Model;

class SaleTicketDetail extends Model
{
    protected $table = "sale_ticket_details";
    protected $fillable = ['amount', 'total', 'ticket_id', 'sale_ticket_id'];
    public $timestamps = false;

    public function saleTicket()
    {
        return $this->belongsTo('App\shopping\SaleTicket');
    }

    public function Ticket()
    {
        return $this->belongsTo('App\marketing\Ticket');
    }

}
