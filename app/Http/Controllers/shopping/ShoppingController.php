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
    
    function booking(){
        $data =[
            'seats_group_1' => Seat::where('group', '=', 1)->get(),
            'seats_group_2' => Seat::where('group', '=', 2)->get(),
            'seats_group_3' => Seat::where('group', '=', 3)->get(),
            'seats_group_4' => Seat::where('group', '=', 4)->get(),
            'seats_group_5' => Seat::where('group', '=', 5)->get(),
            'seats_group_6' => Seat::where('group', '=', 6)->get(),
        ];
        return view('shopping/booking', $data);
    }
}
