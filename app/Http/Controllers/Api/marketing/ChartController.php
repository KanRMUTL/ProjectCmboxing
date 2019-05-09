<?php

namespace App\Http\Controllers\Api\marketing;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\marketing\StarterController;
use Illuminate\Support\Facades\DB;
use App\marketing\Sale;
use App\User;
use Auth;

class ChartController extends StarterController
{
     public function zoneSaling(Request $request) {
          $sale = Sale::zoneSaling($request->start, $request->end);
          $data['labels'] = $sale->map->labels;
          $data['total'] = $sale->map->total;
          return response()->json($data);
     }

     public function ticketSaling(Request $request) {
          $user = User::find($request->id);
          $sale = Sale::ticketSaling($request->start, $request->end, $user);
          $data['labels'] = $sale->map->labels;
          $data['total'] = $sale->map->total;
          return response()->json($data);
     }

     public function ticketAmountSaling(Request $request) {
           $user = User::find($request->id);
          $sale = Sale::ticketAmountSaling($request->start, $request->end, $user);
          $data['labels'] = $sale->map->labels;
          $data['total'] = $sale->map->total;
          return response()->json($data);
     }
}
   