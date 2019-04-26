<?php

namespace App\Http\Controllers\pos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PosController extends Controller
{
    
    public function product()
    {
        return view('pos/product');
    }

    public function saleReport()
    {
        return view('pos/report');
    }

    function sale()
    {
        return view("pos.sale_product");
    }


}
