<?php

namespace App\Http\Controllers\Api\shopping;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Carbon\Carbon;
use App\Paypal\GetOrder;

class PaymentController extends StarterController
{
    public function payment(Request $request)
    {
        try{
            $getOrder = GetOrder::getOrder($request->orderID, true);
        }
        catch(Exception $e) {
            echo $e;
        }
        finally {
            return response()->json($getOrder);
        }
    }
}
