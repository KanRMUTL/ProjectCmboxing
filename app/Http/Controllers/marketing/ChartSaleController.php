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
        return view('chart');
    }

    public function zonePage()
    {
        return view('_sale.chart_zone');
    }
    public function getJson()  // ฟังชั่นทดสอบ
    {
        Sale::get();
        $data = Sale::chartWeek('2018-12-2')->get();
        $count = $data->count();
        return $data;
    }

    public function chartZone(Request $request) // สำหรับ Admin เท่านั้น
    {
        $before = $request->before;
        $after  = $request->after; 
        $sale =  Sale::chartZone($before, $after)->get();
        
        $index = 0;
        foreach ($sale as $item) {  
            $sale[$index]['zone_name'] = $item->zone->name;
            $index++;
        }
        return response($sale, 200)->header('Content-Type', 'text/plain');
    }
} 
