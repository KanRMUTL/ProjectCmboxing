<?php

namespace App\marketing;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Auth;

class Sale extends Model
{
    protected $table = 'sales';
    protected $fillable = [
        'amount',
        'total',
        'customer_name',
        'customer_phone',
        'customer_room',
        'visit',
        'ticket_id',
        'user_id',
        'zone_id',
        'guesthouse_id',
        'sale_type_id'
    ];
    public $timestamps  = false;
    public  $roleId;
    public $now;
    public $startOfWeek;
    public $endOfWeek;

    public function __construct()
    {
        $this->roleId = Auth::user()->role_id;
        $this->now = Carbon::now();
        $this->startOfWeek =  $this->now->startOfWeek()->format('Y-m-d');
        $this->endOfWeek = $this->now->endOfWeek()->format('Y-m-d');
    }
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
    public function zone()
    {
        return $this->belongsTo('App\marketing\Zone');
    }

    public function saleType()
    {
        return $this->belongsTo('App\marketing\SaleType');
    }
    public function scopeSaleDetail($query, $before, $after, $zoneId = null, $saleType = null)
    {
        if($this->roleId == 1){
            return $query
                ->where([
                    ['zone_id', '=', $zoneId],
                    ['sale_type_id', '=', $saleType]
                ])
                ->whereBetween('created_at', [$before, $after])
                ->orderByRaw('created_at DESC');
        }else if($this->roleId == 2){
            return $query
                ->where('zone_id', '=', $zoneId)
                ->whereBetween('created_at', [$before, $after])
                ->orderByRaw('created_at DESC');
        }else if($this->roleId == 3){
            return $query
                ->where('user_id', '=', Auth::user()->id)
                ->whereBetween('created_at', [$before, $after])
                ->orderByRaw('created_at DESC');
        }
    }


    public function scopeCommission($query, $before, $after, $zoneId = null, $saleTypeId)
    {
        if($this->roleId == 1){
            return $query
                ->select(
                    'user_id', 
                    DB::raw('SUM(amount) as amount'), 
                    'ticket_id',                      
                    'created_at'
                )
                ->where([
                    ['zone_id', '=', $zoneId],
                    ['sale_type_id', '=', $saleTypeId]
                ])
                ->whereBetween('created_at', [$before, $after])
                ->groupBy('ticket_id', 'created_at', 'user_id')
                ->orderByRaw('created_at DESC');
        }
        else if($this->roleId == 2) {
            return $query
                ->select(
                    'user_id', 
                    DB::raw('SUM(amount) as amount'), 
                    'ticket_id',
                    'created_at'                        
                )
                ->where([
                    ['zone_id', '=', Auth::user()->zone_id],
                    ['sale_type_id', '=', $saleId]    
                ])
                ->whereBetween('created_at', [$before, $after])
                ->groupBy('ticket_id', 'created_at', 'user_id')
                ->orderByRaw('created_at DESC');
        }
        else if($this->roleId == 3){
            return $query
                ->select(
                    'user_id', 
                    DB::raw('SUM(amount) as amount'), 
                    'ticket_id',                      
                    'created_at'
                )
                ->where([
                    ['user_id', '=', Auth::user()->id],
                    ['sale_type_id', '=', $saleId]    
                ])
                ->whereBetween('created_at', [$before, $after])
                ->groupBy('ticket_id', 'created_at', 'user_id')
                ->orderByRaw('created_at DESC');
        }
    }

    public function getVisitAttribute($value)
    {
        $visit = Carbon::parse($value);
        return $visit->format('d/m/Y');
    }
    
}
