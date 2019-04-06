<?php

namespace App\Http\Controllers\Api\pos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\pos\Bill;
use App\pos\Product;
use App\pos\SaleDetail;
use Auth;

class ProductController extends Controller
{
    
    public function index()
    {
        $products = Product::all();
        return response()->json($products);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $product = new Product();
        $product->barcode = $request->barcode;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->unit = $request->unit;
        $product->amount = $request->amount;
        $product->save();
        return response()->json($product);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $product->barcode = $request->barcode;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->unit = $request->unit;
        $product->amount = $request->amount;
        $product->update();
        return response()->json($product);
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return response()->json($product);
    }
}
