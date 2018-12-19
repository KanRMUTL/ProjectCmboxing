<?php

namespace App\marketing;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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
        'zone_id',
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
    public function zone()
    {
        return $this->belongsTo('App\marketing\Zone');
    }
    public function scopeSale($query)
    {
        if(Auth::user()->role_id == 1){
            return $query->orderBy('visit'); // เรียงตามวันที่มาชมมวย
        }else if(Auth::user()->role_id == 2){
            return $query
                ->join('users','users.id', '=','sales.user_id')
                ->join('zones',function($join){
                    $join->on('zones.id','=', 'users.zone_id')
                        ->where('zones.id', '=', Auth::user()->zone_id);
                })
                ->orderBy('visit');
        }else if(Auth::user()->role_id == 3){
            return $query->where('user_id', '=', Auth::user()->id)->orderBy('visit');;
        }
    }

    public function scopeChartWeek($query,$date)
    {
        $now = Carbon::now();
        // $now = Carbon::parse($date); // นำค่า $date ส่งให้ Carbon::class เพื่อเอาไปใช้กับ format()
        return $query->select('customer_name','total')
        ->whereBetween('created_at', [
            $now->startOfWeek()->format('Y-m-d'),
            $now->endOfWeek()->format('Y-m-d'),
        ]);
    }

    public function scopeChartZone($query,$before, $after)  // หารายได้ของแต่ละโซนรวมกันทั้งหมดเรียงจากมากไปน้อย
    {
       return $query
                ->select('zone_id',DB::raw('SUM(total) as total'))
                ->whereBetween('created_at',[$before, $after])
                ->groupBy('zone_id')
                ->orderBy(DB::raw('SUM(total)'),'ADSC');
    }

    // public function scopeChartZone($query)  
    // {
    //     return $query
    //             ->select
    // }

    public function getVisitAttribute($value)
    {
        $visit = Carbon::parse($value);
        return $visit->format('d/m/Y');
    }
    
    
}
