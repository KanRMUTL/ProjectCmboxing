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
        $seat = Seat::forBooking()->get();
        $data['seat'] = $this->addAttribute($seat, $today);
        // $group1 = Seat::forBooking(1)->get();
        // $group2 = Seat::forBooking(2)->get();
        // $group3 = Seat::forBooking(3)->get();
        // $group4 = Seat::forBooking(4)->get();
        // $group5 = Seat::forBooking(5)->get();
        // $group6 = Seat::forBooking(6)->get();
        // $data =[
        //     'seats_group_1' => $this->addAttribute($group1, $today),
        //     'seats_group_2' => $this->addAttribute($group2, $today),
        //     'seats_group_3' => $this->addAttribute($group3, $today),
        //     'seats_group_4' => $this->addAttribute($group4, $today),
        //     'seats_group_5' => $this->addAttribute($group5, $today),
        //     'seats_group_6' => $this->addAttribute($group6, $today),
        // ];
        
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

    public function addAttribute($seat ,$date)
    {
        foreach($seat as $index => $item) 
        {
            $seat[$index]['status'] = true;
            $seat[$index]['booked'] = false;
            if(SeatRegister::CheckVisit($item->seatId, $date) > 0)
            {
                $seat[$index]['status'] = false;
            }
        }

        return $seat;
    }

    public function search(Request $request)
    {
        $today = Carbon::today();
        $seat = Seat::forBooking()->get();
        $data['seat'] = $this->addAttribute($seat, $request->dateSearch);
        // $group1 = Seat::forBooking(1)->get();
        // $group2 = Seat::forBooking(2)->get();
        // $group3 = Seat::forBooking(3)->get();
        // $group4 = Seat::forBooking(4)->get();
        // $group5 = Seat::forBooking(5)->get();
        // $group6 = Seat::forBooking(6)->get();
        // $data =[
        //     'seats_group_1' => $this->addAttribute($group1, $request->dateSearch),
        //     'seats_group_2' => $this->addAttribute($group2, $request->dateSearch),
        //     'seats_group_3' => $this->addAttribute($group3, $request->dateSearch),
        //     'seats_group_4' => $this->addAttribute($group4, $request->dateSearch),
        //     'seats_group_5' => $this->addAttribute($group5, $request->dateSearch),
        //     'seats_group_6' => $this->addAttribute($group6, $request->dateSearch),
        // ];
        // $data['date'] = $request->dateSearch;
        return response()->json($data); return response()->json($data);
    }
}
