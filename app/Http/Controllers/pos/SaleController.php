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
        return view("pos/sale_product");
    }

    function getProduct(Request $request)
    {
        $data = Product::where("barcode", "LIKE", $request->input('barcode'))->first();
        return $data;
    }

    function checkBill(Request $request)
    {
        // $bill = [
        //     "total" => $request->total,
        //     "user_id" => Auth::user()->id
        // ];
        // Bill::insert($bill);

        return $request;
    }
}
