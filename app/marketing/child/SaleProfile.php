<?php

namespace App\marketing\child;
use App\marketing\Sale;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Auth;

class SaleProfile extends Sale
{
    public function scopeTicketSaling($query, $user_id) {
        // นับลูกค้า / การขายบัตรแต่ละประภท
        return $query
                ->join('tickets', 'sales.ticket_id', '=', 'tickets.id')
                ->select(
                    DB::raw('count(amount) as count'),
                    DB::raw('count(amount) * tickets.price as total'),
                    'ticket_id',
                    'tickets.name'
                )
                ->where('user_id', $user_id)
                ->groupBy('ticket_id');
    }

    public function scopeCommissionProfile($query, $user_id, $start, $end, $sale_type) {
        return $query   
                ->select(
                    DB::raw('SUM(amount) as amount'),  
                    DB::raw('DATE(created_at) as dateCreatedAt'),
                    'ticket_id'     
                )
                ->where([
                    ['user_id', '=', $user_id],
                    ['sale_type', '=', $sale_type]    
                ])
                ->whereBetween('created_at', [$start, $end])
                ->groupBy('dateCreatedAt', 'ticket_id')
                ->orderByRaw('created_at DESC');
    }

    public function scopeIncomeProfile($query, $user_id, $start, $end) 
    {
        return $query  
                ->select(
                    DB::raw('SUM(amount) AS amount'), 
                    'ticket_id', 
                    DB::raw('SUM(total) AS sumTotal'), 
                    'sale_type',
                    DB::raw('DATE(created_at) as dateCreatedAt')
                )
                ->where(['user_id' => $user_id]) 
                ->whereBetween('created_at', [$start, $end])
                ->groupBy('dateCreatedAt', 'ticket_id', 'sale_type', 'created_at')
                ->orderByRaw('created_at DESC');
    }
}
