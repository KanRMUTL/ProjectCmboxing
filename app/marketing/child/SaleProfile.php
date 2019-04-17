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
                    'user_id', 
                    DB::raw('SUM(amount) as amount'),  
                    DB::raw('DATE(created_at) as dateCreated_at'),
                    'ticket_id',                      
                    DB::raw('DATE(created_at)')
                )
                ->where([
                    ['user_id', '=', $user_id],
                    ['sale_type', '=', $sale_type]    
                ])
                ->whereBetween('created_at', [$start, $end])
                ->groupBy('dateCreated_at', 'created_at', 'ticket_id')
                ->orderByRaw('created_at DESC');
    }
}
