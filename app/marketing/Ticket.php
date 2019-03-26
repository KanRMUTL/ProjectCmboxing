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
    
}
