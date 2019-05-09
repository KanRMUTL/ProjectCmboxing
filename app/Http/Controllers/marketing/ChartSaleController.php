<?php

namespace App\Http\Controllers\marketing;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\marketing\Sale;
use Carbon\Carbon;
use App\User;
use App\Http\Controllers\marketing;
class ChartSaleController {

    public function index()
    {
        return view('marketing._sale.chart');
    }

} 
