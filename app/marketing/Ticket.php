<?php

namespace App\marketing;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'name', 'price', 'img'
    ];
    public $timestamps  = false;
    
    public function employee_commission()
    {
        return $this->hasOne('App\marketing\EmployeeCommission');
    }

    public function guide_commission()
    {
        return $this->hasOne('App\marketing\GuideCommission');
    }

    public function sales()
    {
        return $this->hasMany('App\marketing\Sale');
    }

    public function seats()
    {
        return $this->hasMany('App\shopping\Seat');
    }
    
    public function saleTicketDetil()
    {
        return $this->hasMany('App\shopping\SaleTicketDetail');
    }

    public function scopeJoinGuideCommission($query) 
    {
        return $query
                ->select(
                    'tickets.id',
                    'guide_commissions.id as commId',
                    'guide_commissions.commission',
                    'tickets.price',
                    'tickets.name',
                    'tickets.img'
                )
                ->join('guide_commissions', 'tickets.id', '=', 'guide_commissions.ticket_id');
    }

}
