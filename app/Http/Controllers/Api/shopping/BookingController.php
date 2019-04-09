<?php

namespace App\Http\Controllers\Api\shopping;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Carbon\Carbon;
use App\shopping\Seat;
use App\marketing\Ticket;
use App\shopping\WebDetail;
use App\shopping\SeatRegister;
use App\shopping\SaleTicket;
use App\shopping\SaleTicketDetail;
use App\Http\Controllers\marketing\StarterController;

class BookingController extends StarterController
{

    public function index()
    {
        $today = Carbon::today();
        $seat = Seat::forBooking()->get();
        $data['seat'] = $this->addAttribute($seat, $today);
        return response()->json($data);
    }

    
    public function create()
    {
        //
    }

  
    public function store(Request $request)
    {
        $saleTicket = new SaleTicket();
        
        
        $saleTicket->visit = $request->dateVisit;
        $saleTicket->total = $request->total;
        $saleTicket->user_id = $request->userId;
        $saleTicket->save();
        
        foreach($request->bookDetail as $detail)
        {
            $seatRegister = new SeatRegister;
            $saleTicketDetail = new SaleTicketDetail();

            $seatRegister->visit = $request->dateVisit;
            $seatRegister->sale_ticket_id = $saleTicket->id;
            $seatRegister->seat_id = $detail['seatId'];
            $seatRegister->save();

            $saleTicketDetail->amount = 1;
            $saleTicketDetail->total = $detail['price'];
            $saleTicketDetail->ticket_id = $detail['ticketId'];
            $saleTicketDetail->sale_ticket_id = $saleTicket->id;
            $saleTicketDetail->save();

        }
        return response()->json();
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
        return response()->json($data); return response()->json($data);
    }
}
