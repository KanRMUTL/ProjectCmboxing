<?php

namespace App\Http\Controllers\Api\shopping;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\shopping\Seat;
use App\marketing\Ticket;
use App\shopping\WebDetail;
use App\Http\Controllers\marketing\StarterController;

class ShoppingController extends StarterController
{
    function ticket()
    {
        $data['tickets'] = $this->tickets;
        return response()->json($data);
    }

    function about()
    {
        $data['webdetail'] = WebDetail::find(1);        
        return response()->json($data);
    }
}
