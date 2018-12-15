<?php

namespace App\marketing;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
        'amount',
        'total',
        'customer_name',
        'customer_phone',
        'customer_room',
        'visit',
        'ticket_id',
        'user_id',
        'guesthouse_id'
    ];

    public function ticket()
    {
        return $this->belongsTo('App\marketing\Ticket');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function incomes()
    {
        return $this->hasMany('App\marketing\Income');
    }

    public function guesthouse()
    {
        return $this->belongsTo('App\marketing\Guesthouse');
    }

}
