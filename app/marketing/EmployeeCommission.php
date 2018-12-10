<?php

namespace App\marketing;

use Illuminate\Database\Eloquent\Model;

class EmployeeCommission extends Model
{
    
    protected $fillable = [
        'commission',
        'customer_amount',
        'ticket_id'
    ];

    public function ticket()
    {
        return $this->belongsTo('App\marketing\Ticket');
    }

}
