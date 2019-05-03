<?php

namespace App\Http\Controllers\Api\pos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\pos\Bill;
use App\pos\Product;
use App\pos\SaleDetail;
use Auth;

class SalingController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return response()->json($products);
    }

    public function create()
    {
        
    }

    public function store(Request $request)
    {
        $bill = new Bill();
        $bill->total = $request->sumTotal;
        $bill->user_id = $request->id;
        $bill->save();

        foreach($request->products as $item)
        {
            $saleDetail = new SaleDetail();
            $product = Product::find($item['id']);
            
            // บันทึกรายการขาย
            $saleDetail->amount = $item['cart'];
            $saleDetail->total = $item['total'];
            $saleDetail->product_id = $item['id'];
            $saleDetail->bill_id = $bill->id;
            $saleDetail->save();
            
            //อัพเดทจำนวนสินค้า
            $product->amount -= $item['cart'];
            $product->update();
        }

        return response()->json($request);
    }

    public function show($barcode)
    {
        //ตอนที่สแกนบาร์โค้ด
        $product = Product::select('id','name', 'img','barcode','price', 'amount',  DB::raw('(price) as total'))->where('barcode', $barcode)->get();
        return response()->json($product);
    }
    
    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
