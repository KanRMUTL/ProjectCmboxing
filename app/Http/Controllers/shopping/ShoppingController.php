<?php

namespace App\Http\Controllers\shopping;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\shopping\Seat;
use App\marketing\Ticket;
use App\shopping\WebDetail;
use App\Http\Controllers\marketing\StarterController;

class ShoppingController extends StarterController
{
    function index()
    {
        $data = [
            'tickets' => $this->tickets
        ];
        return view('shopping/index', $data);
    }

    function about()
    {
        $data = [
            'webdetail' => WebDetail::find(1)
        ];
        
        return view('shopping/about', $data);
    }
}
