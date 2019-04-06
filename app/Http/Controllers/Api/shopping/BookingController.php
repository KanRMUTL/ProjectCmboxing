<?php

namespace App\Http\Controllers\Api\shopping;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\shopping\Seat;
use App\marketing\Ticket;
use App\shopping\WebDetail;
use App\Http\Controllers\marketing\StarterController;

class BookingController extends StarterController
{
   
    public function index()
    {
        $data =[
            'seats_group_1' => Seat::join('tickets', 'seats.ticket_id', '=', 'tickets.id')->where('group', '=', 1)->get(),
            'seats_group_2' => Seat::join('tickets', 'seats.ticket_id', '=', 'tickets.id')->where('group', '=', 2)->get(),
            'seats_group_3' => Seat::join('tickets', 'seats.ticket_id', '=', 'tickets.id')->where('group', '=', 3)->get(),
            'seats_group_4' => Seat::join('tickets', 'seats.ticket_id', '=', 'tickets.id')->where('group', '=', 4)->get(),
            'seats_group_5' => Seat::join('tickets', 'seats.ticket_id', '=', 'tickets.id')->where('group', '=', 5)->get(),
            'seats_group_6' => Seat::join('tickets', 'seats.ticket_id', '=', 'tickets.id')->where('group', '=', 6)->get(),
        ];
        return response()->json($data);
    }

    
    public function create()
    {
        //
    }

  
    public function store(Request $request)
    {
        //
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
        //
    }

   
    public function destroy($id)
    {
        //
    }
}
