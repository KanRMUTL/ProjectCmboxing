<?php

namespace App\marketing;

use Illuminate\Database\Eloquent\Model;

class GuideCommission extends Model
{
    protected $fillable = [
        'commission',
        'ticket_id'
    ];

    public function ticket()
    {
        return $this->belongsTo('App\marketing\Ticket');
    }
}
