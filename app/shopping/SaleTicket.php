<?php

namespace App\shopping;

use Illuminate\Database\Eloquent\Model;

class SaleTicket extends Model
{
    protected $table = 'sale_tickets';
    protected $fillable = ['visit', 'total', 'created_at', 'user_id'];
    public $timestamps = false;

    public function SaleTicketDetail()
    {
        return $this->hasMany('App\shopping\SaleTicketDetail');
    }

    public function scopeTicketDetail($query, $userId)
    {
        return $query
            ->select(
                'id',
                'visit',
                'created_at'
            )
            ->where([
                ['sale_tickets.user_id', '=', $userId]
            ])
            ->orderBy('created_at', 'DESC');
    }

    public function scopeSearch($query, $start, $end)
    {
        return $query
            ->join('users', 'sale_tickets.user_id', '=', 'users.id')
            ->select(
                'sale_tickets.id',
                'visit',
                'total',
                'created_at',
                'users.firstname',
                'users.lastname'
            )
            ->whereBetween('created_at', [$start, $end])
            ->orderBy('created_at', 'DESC');
    }
}
