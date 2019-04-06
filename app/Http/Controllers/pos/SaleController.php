<?php

namespace App\Http\Controllers\pos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\pos\Product;
use App\pos\Bill;

class SaleController extends Controller
{
    function index()
    {
        return view("pos.sale_product");
    }

    function report()
    {
        return view("pos.report");
    }

    // function getProduct(Request $request)
    // {
    //     $data = Product::where("barcode", "LIKE", $request->input('barcode'))->first();
    //     return $data;
    // }
}
