<?php

namespace App\Http\Controllers\marketing;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\marketing\Sale;
use App\marketing\child\Chart;
use Carbon\Carbon;
use App\User;
use App\Http\Controllers\marketing;
class ChartSaleController extends StarterController
{
    public function __construce()
    {
        parent::__construce();
    }

    public function index()
    {
        $data = [
            'start' => $this->start,
            'end' => $this->end
        ];
        return view('_sale.chart', $data);
    }

    public function apiZoneTotal(Request $request) // สำหรับ Admin เท่านั้น
    {
        $before = $request->before;
        $after  = $request->after; 
        $sale =  Chart::chartZoneTotal($before, $after)->get();
        
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
        $sale = Chart::ChartZoneCustomer($before, $after)->get();
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
        $sale = Chart::chartTicket($before, $after)->get();
        $index = 0;
        foreach ($sale as $item) {  
            $sale[$index]['ticket_name'] = $item->ticket->name;
            $index++;
        }
        return response($sale, 200)->header('Content-Type', 'text/plain');
    }

    public function apiChartAmountCustomer(Request $request)
    {
        $before = $request->before;
        $after  = $request->after; 
        $sale = Chart::chartAmountCustomer($before, $after)->get();
        $index = 0;
        foreach ($sale as $item) {  
            $sale[$index]['name'] = $item->user->name;
            $index++;
        }
        return response($sale, 200)->header('Content-Type', 'text/plain');
    }
} 
