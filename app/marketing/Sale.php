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
        'sale_type',
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
        // Auth::user()->role = Auth::user()->role;
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
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function guesthouse()
    {
        return $this->belongsTo('App\marketing\Guesthouse');
    }
    public function zone()
    {
        return $this->belongsTo('App\marketing\Zone', 'zone_id',  'id');
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

    /* =======  End Dashboard ======== */

    public function getVisitAttribute($value)
    {
        $visit = Carbon::parse($value);
        return $visit->format('d/m/Y');
    }

    // ========== Chart ==========
    public function scopeZoneSaling($query, $start, $end) {
        return $query
                ->select('zones.name as labels', DB::raw('SUM(total) as total'))
                ->join('zones', 'sales.zone_id', 'zones.id')
                ->groupBy('zone_id')
                ->orderBy('total')
                ->whereBetween(DB::raw('DATE(created_at)'),  [DB::raw(DATE($start)), DB::raw(DATE($end))])
                ->get();
   }

   public function scopeTicketSaling($query, $start, $end, $user) {
       if($user->role == 1) {
           return $query
                ->select('tickets.name as labels', DB::raw('SUM(total) as total'))
                ->join('tickets', 'sales.ticket_id', 'tickets.id')
                ->groupBy('ticket_id')
                ->orderBy('total')
                ->whereBetween(DB::raw('DATE(created_at)'),  [DB::raw(DATE($start)), DB::raw(DATE($end))])
                ->get();
       } else if($user->role == 2) {
        return $query
                ->select('tickets.name as labels', DB::raw('SUM(total) as total'))
                ->join('tickets', 'sales.ticket_id', 'tickets.id')
                ->groupBy('ticket_id')
                ->orderBy('total')
                ->where('zone_id', '=', $user->employee->zone_id)
                ->whereBetween(DB::raw('DATE(created_at)'),  [DB::raw(DATE($start)), DB::raw(DATE($end))])
                ->get();
       }  else if($user->role == 3) {
        return $query
                ->select('tickets.name as labels', DB::raw('SUM(total) as total'))
                ->join('tickets', 'sales.ticket_id', 'tickets.id')
                ->groupBy('ticket_id')
                ->orderBy('total')
                ->where('user_id', '=', $user->id)
                ->whereBetween(DB::raw('DATE(created_at)'),  [DB::raw(DATE($start)), DB::raw(DATE($end))])
                ->get();
       } 
   }

   public function scopeTicketAmountSaling($query, $start, $end, $user) {
       if($user->role == 1) {
        return $query 
                ->select('tickets.name as labels', DB::raw('SUM(amount) as total'))
                ->join('tickets', 'sales.ticket_id', 'tickets.id')
                ->groupBy('ticket_id')
                ->orderBy('total')
                ->whereBetween(DB::raw('DATE(created_at)'),  [DB::raw(DATE($start)), DB::raw(DATE($end))])
                ->get();
       } else if ($user->role == 2) {
        return $query 
                ->select('tickets.name as labels', DB::raw('SUM(amount) as total'))
                ->join('tickets', 'sales.ticket_id', 'tickets.id')
                ->groupBy('ticket_id')
                ->orderBy('total')
                ->where('zone_id', '=', $user->employee->zone_id)
                ->whereBetween(DB::raw('DATE(created_at)'),  [DB::raw(DATE($start)), DB::raw(DATE($end))])
                ->get();    
        } else if ($user->role == 3) {
            return $query 
                    ->select('tickets.name as labels', DB::raw('SUM(amount) as total'))
                    ->join('tickets', 'sales.ticket_id', 'tickets.id')
                    ->groupBy('ticket_id')
                    ->orderBy('total')
                    ->where('user_id', '=', $user->id)
                    ->whereBetween(DB::raw('DATE(created_at)'),  [DB::raw(DATE($start)), DB::raw(DATE($end))])
                    ->get();    
        }
   }
}
