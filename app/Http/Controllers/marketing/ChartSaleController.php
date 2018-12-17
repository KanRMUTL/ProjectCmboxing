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
    public function getJson()
    {
        Sale::get();
        // return Carbon::now();
        // dd(Carbon::now()->toDateTimeString());
        // dd(Carbon::createFromFormat('Y-m-d H' , Carbon::now()->toDateTimeString()));
        // dd(Carbon::createFromFormat('Y-m-d', '1975-05-21 22')->toDateTimeString());
        $data = Sale::chartWeek('2018-12-2')->get();
        $count = $data->count();
        return $data;
    }

    public function chartZone() // สำหรับ Admin เท่านั้น
    {
         $sale =  Sale::chartZone()->get();
        
        $index = 0;
        foreach ($sale as $item) {  
            $sale[$index]['zone_name'] = $item->zone->name;
            $index++;
        }
        return $sale;
    }
}
