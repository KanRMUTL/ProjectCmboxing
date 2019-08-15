<?php

namespace App\Http\Controllers\Api\pos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\pos\Bill;
use App\pos\Product;
use App\pos\SaleDetail;
use Auth;

class ReportController extends Controller
{
    public function index()
    {
        $bills = Bill::
                    join('users', 'bills.user_id', '=', 'users.id')
                    ->select('bills.id', 'total', 'created_at', 'users.firstname', 'users.lastname')
                    ->get();
        return response()->json($bills);
    }

    public function create()
    {
        
    }

    public function store(Request $request)
    {
        $bills = Bill::
                join('users', 'bills.user_id', '=', 'users.id')
                ->select('bills.id', 'total', 'created_at', 'users.firstname', 'users.lastname')
                ->whereBetween(DB::raw('DATE(bills.created_at)'), [DB::raw(DATE($request->start)), DB::raw(DATE($request->end))])
                ->get();
        return response()->json($bills);
    }

    public function show($id)
    {
        $saleDetail = Bill::
                            select('sale_details.amount', 'products.name', 'products.img', 'products.price', 'sale_details.total')
                            ->join('sale_details', 'bills.id', '=', 'sale_details.bill_id')
                            ->join('products', 'sale_details.product_id', '=', 'products.id')
                            ->where('bills.id', '=', $id)
                            ->get();
        return $saleDetail;
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
