<?php

namespace App\marketing;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Carbon\Carbon;

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
                });
        }else if(Auth::user()->role_id == 3){
            return $query->where('user_id', '=', Auth::user()->id);
        }
    }

    public function getVisitAttribute($value)
    {
        $visit = Carbon::parse($value);
        return $visit->format('d/m/Y');
    }
    
}
