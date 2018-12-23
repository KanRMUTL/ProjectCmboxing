<?php

namespace App\Http\Controllers\marketing;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\marketing\Sale;
use Carbon\Carbon;
use App\User;
class ChartSaleController extends Controller
{
    

    public function index()
    {
        $now = Carbon::now();
        $start =  $now->startOfWeek()->format('Y-m-d');
        $end = $now->endOfWeek()->format('Y-m-d');

        $data = [
            'start' => $start,
            'end' => $end
        ];
        return view('_sale.chart', $data);
    }
    

    public function apiZoneTotal(Request $request) // สำหรับ Admin เท่านั้น
    {
        $before = $request->before;
        $after  = $request->after; 
        $sale =  Sale::chartZoneTotal($before, $after)->get();
        
        $index = 0;
        foreach ($sale as $item) {  
            $sale[$index]['zone_name'] = $item->zone->name;
            $index++;
        }
        return response($sale, 200)->header('Content-Type', 'text/plain');
    }

    public function apiZoneCustomer(Request $request)
    {
        $before = $request->before;
        $after  = $request->after; 
        $sale = Sale::ChartZoneCustomer($before, $after)->get();
        $index = 0;
        foreach ($sale as $item) {  
            $sale[$index]['zone_name'] = $item->zone->name;
            $index++;
        }
        return response($sale, 200)->header('Content-Type', 'text/plain');
    }

    public function apiTicket(Request $request)
    {
        $before = $request->before;
        $after  = $request->after; 
        $sale = Sale::chartTicket($before, $after)->get();
        $index = 0;
        foreach ($sale as $item) {  
            $sale[$index]['ticket_name'] = $item->ticket->name;
            $index++;
        }
        return response($sale, 200)->header('Content-Type', 'text/plain');
    }
} 
