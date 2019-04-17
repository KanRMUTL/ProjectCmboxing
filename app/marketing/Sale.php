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
    ];
    public $timestamps  = false;
    public  $roleId;
    public $now;
    public $startOfWeek;
    public $endOfWeek;

    public function __construct()
    {
        $this->roleId = Auth::user()->role;
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
        if($this->roleId == 1)
        {   
            // แอดมิน
            return $query
                ->where(
                    [
                        ['zone_id', '=', $zoneId], 
                        ['sale_type', '=', $saleType]
                    ]
                )
                ->whereBetween('created_at', [$before, $after])
                ->orderByRaw('created_at DESC');
        }
        else if($this->roleId == 2)
        {   
            // หัวหน้าฝ่ายการตลาด
            return $query
                ->where(
                    [
                        ['zone_id', '=', $zoneId], 
                        ['sale_type', '=', $saleType]
                    ]
                )
                ->whereBetween('created_at', [$before, $after])
                ->orderByRaw('created_at DESC');
        }
        else if($this->roleId == 3)
        {   
            // พนักงานการตลาด
            return $query
                ->where(
                    [
                        ['zone_id', '=', $zoneId], 
                        ['sale_type', '=', $saleType],
                        ['user_id', '=', Auth::user()->id]
                    ]
                )
                ->whereBetween('created_at', [$before, $after])
                ->orderByRaw('created_at DESC');
        }
    }

    public function scopeCommission($query, $before, $after, $zoneId = null, $saleTypeId)
    {
        if($this->roleId == 1){ // แอดมิน
            return $query
                ->select(
                    'user_id', 
                    DB::raw('SUM(amount) as amount'), 
                    'ticket_id',                      
                    DB::raw('DATE(created_at) as date_created_at')
                )
                ->where([
                    ['zone_id', '=', $zoneId],
                    ['sale_type', '=', $saleTypeId]
                ])
                ->whereBetween('created_at', [$before, $after])
                ->groupBy('date_created_at', 'user_id', 'ticket_id')
                ->orderByRaw('created_at DESC');
        }
        else if($this->roleId == 2) { // หัวหน้าฝ่ายการตลาด
            return $query
                ->select(
                    'user_id', 
                    DB::raw('SUM(amount) as amount'), 
                    'ticket_id',
                    'created_at'                        
                )
                ->where([
                    ['zone_id', '=',  Auth::user()->employee->zone_id],
                    ['sale_type', '=', $saleId]    
                ])
                ->whereBetween('created_at', [$before, $after])
                ->groupBy('user_id','created_at', 'ticket_id')
                ->orderByRaw('created_at DESC');
        }
        else if($this->roleId == 3){ // พนักงาน
            return $query
                ->select(
                    'user_id', 
                    DB::raw('SUM(amount) as amount'), 
                    'ticket_id',                      
                    'created_at'
                )
                ->where([
                    ['user_id', '=', Auth::user()->id],
                    ['sale_type', '=', $saleId]    
                ])
                ->whereBetween('created_at', [$before, $after])
                ->groupBy('user_id','created_at', 'ticket_id')
                ->orderByRaw('created_at DESC');
        }
    }

    public function scopeIncome($query, $zoneId, $before, $after)
    {
        if(Auth::user()->role == 1)
        {
             return $query  
                ->select(
                    'user_id',
                    DB::raw('SUM(amount) AS amount'), 
                    'ticket_id', 
                    DB::raw('SUM(total) AS total'), 
                    'sale_type',
                    'created_at')
                ->groupBy('user_id', 'ticket_id', 'sale_type', 'created_at')
                ->orderByRaw('created_at DESC')
                ->where(['zone_id' => $zoneId])
                ->whereBetween('created_at', [$before, $after]);
        }
        else if(Auth::user()->role == 2)
        {
            return $query  
                ->select(
                    'user_id',
                    DB::raw('SUM(amount) AS amount'), 
                    'ticket_id', 
                    DB::raw('SUM(total) AS total'), 
                    'sale_type',
                    'created_at')
                ->groupBy('user_id', 'ticket_id', 'sale_type', 'created_at')
                ->where(['zone_id' => $zoneId])
                ->whereBetween('created_at', [$before, $after])
                ->orderByRaw('created_at DESC');
        }
        else if(Auth::user()->role == 3)
        {
            return $query  
                ->select(
                    'user_id',
                    DB::raw('SUM(amount) AS amount'), 
                    'ticket_id', 
                    DB::raw('SUM(total) AS total'), 
                    'sale_type',
                    'created_at')
                ->groupBy('user_id', 'ticket_id', 'sale_type', 'created_at')
                ->where(['user_id' => Auth::user()->id])
                ->whereBetween('created_at', [$before, $after])
                ->orderByRaw('created_at DESC');;
        }
    }

    /* ======= Dasboard ======== */
    public function scopeAmountTicket($query, $startOfWeek, $endOfWeek)
    {
        if( Auth::user()->role == 1){
            return $query->
                    select(DB::raw('SUM(amount) as amount'))
                    ->whereBetween('created_at', [$startOfWeek, $endOfWeek]);
        }
        else if(Auth::user()->role == 2){
            return $query->
                    select(DB::raw('SUM(amount) as amount'))
                    ->where('zone_id', '=',  Auth::user()->employee->zone_id )
                    ->whereBetween('created_at', [$startOfWeek, $endOfWeek]);
        }
        else if( Auth::user()->role== 3){
            return $query->
                    select(DB::raw('SUM(amount) as amount'))
                    ->where('user_id', '=', Auth::user()->id )
                    ->whereBetween('created_at', [$startOfWeek, $endOfWeek]);
        }
    }

    public function scopeAmountCustomer($query, $startOfWeek, $endOfWeek)
    {
        if( Auth::user()->role == 1){
             return $query->
                select(DB::raw('COUNT(id) as amount'))
                ->whereBetween('created_at', [$this->startOfWeek, $this->endOfWeek]);
        }
        else if(Auth::user()->role == 2){
             return $query->
                select(DB::raw('COUNT(id) as amount'))
                ->where('zone_id', '=',  Auth::user()->employee->zone_id )
                ->whereBetween('created_at', [$this->startOfWeek, $this->endOfWeek]);
        }
        else if( Auth::user()->role== 3){
             return $query->
                select(DB::raw('COUNT(id) as amount'))
                ->where('user_id', '=', Auth::user()->id )
                ->whereBetween('created_at', [$this->startOfWeek, $this->endOfWeek]);
        }
    }

    public function scopeCalIncome($query, $startOfWeek, $endOfWeek)
    {
        if( Auth::user()->role == 1){
            return $query->
                select(DB::raw('SUM(total) as total'))
                ->whereBetween('created_at', [$this->startOfWeek, $this->endOfWeek]);
        }
        else if(Auth::user()->role == 2){
            return $query->
                select(DB::raw('SUM(total) as total'))
                ->where('zone_id', '=',  Auth::user()->employee->zone_id )
                ->whereBetween('created_at', [$this->startOfWeek, $this->endOfWeek]);
        }
        else if( Auth::user()->role== 3){
            return $query->
                select(DB::raw('SUM(total) as total'))
                ->where('user_id', '=', Auth::user()->id )
                ->whereBetween('created_at', [$this->startOfWeek, $this->endOfWeek]);                
        }
    }

    // public function scopeSalingProfile($query, $user_id) {

    // }
    /* =======  End Dashboard ======== */


    /* ======= Commission ======== */

    public function getVisitAttribute($value)
    {
        $visit = Carbon::parse($value);
        return $visit->format('d/m/Y');
    }


}
