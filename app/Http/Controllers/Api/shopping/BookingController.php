<?php

namespace App\Http\Controllers\Api\shopping;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\shopping\Seat;
use App\marketing\Ticket;
use App\shopping\WebDetail;
use App\shopping\SeatRegister;
use App\Http\Controllers\marketing\StarterController;

class BookingController extends StarterController
{
   
    public function index()
    {
        $today = Carbon::today();
        $group1 = Seat::seatByGroup(1)->get();
        $group2 = Seat::seatByGroup(2)->get();
        $group3 = Seat::seatByGroup(3)->get();
        $group4 = Seat::seatByGroup(4)->get();
        $group5 = Seat::seatByGroup(5)->get();
        $group6 = Seat::seatByGroup(6)->get();
        $data =[
            'seats_group_1' => $this->addStatusToSeat($group1, $today),
            'seats_group_2' => $this->addStatusToSeat($group2, $today),
            'seats_group_3' => $this->addStatusToSeat($group3, $today),
            'seats_group_4' => $this->addStatusToSeat($group4, $today),
            'seats_group_5' => $this->addStatusToSeat($group5, $today),
            'seats_group_6' => $this->addStatusToSeat($group6, $today),
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

    public function addStatusToSeat($data ,$date)
    {
        foreach($data as $index => $item) 
        {
            $data[$index]['status'] = true;
            if(SeatRegister::CheckVisit($item->seatId, $date) > 0)
            {
                $data[$index]['status'] = false;
            }
        }

        return $data;
    }

    public function search(Request $request)
    {
        $group1 = Seat::seatByGroup(1)->get();
        $group2 = Seat::seatByGroup(2)->get();
        $group3 = Seat::seatByGroup(3)->get();
        $group4 = Seat::seatByGroup(4)->get();
        $group5 = Seat::seatByGroup(5)->get();
        $group6 = Seat::seatByGroup(6)->get();
        $data =[
            'seats_group_1' => $this->addStatusToSeat($group1, $request->dateSearch),
            'seats_group_2' => $this->addStatusToSeat($group2, $request->dateSearch),
            'seats_group_3' => $this->addStatusToSeat($group3, $request->dateSearch),
            'seats_group_4' => $this->addStatusToSeat($group4, $request->dateSearch),
            'seats_group_5' => $this->addStatusToSeat($group5, $request->dateSearch),
            'seats_group_6' => $this->addStatusToSeat($group6, $request->dateSearch),
        ];
        $data['date'] = $request->dateSearch;
        return response()->json($data); return response()->json($data);
    }
}
