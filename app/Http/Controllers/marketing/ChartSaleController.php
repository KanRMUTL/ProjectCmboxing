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

    public function chartZone()
    {
        $sale =  Sale::chartZone()->get();
        // dd($sale[0]['total']);
        $data = [];
        $index = 0;
        foreach ($sale as $item) {  
            $sale[$index]['name'] = $item->user->name;
            $sale[$index]['zone'] = $item->user->zone->name;
            $index++;
        }
        return $sale;
    }
}
