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

            $seatRegister->visit = $request->dateVisit;
            $seatRegister->sale_ticket_id = $saleTicket->id;
            $seatRegister->seat_id = $detail['seatId'];
            $seatRegister->save();

           
        }

        foreach($request->saleDetail as $saleDetail)
        { 
            if($saleDetail['amount'] > 0)
            {
                $saleTicketDetail = new SaleTicketDetail();
                $saleTicketDetail->amount = $saleDetail['amount'];
                $saleTicketDetail->total = $saleDetail['total'];
                $saleTicketDetail->ticket_id = $saleDetail['ticketId'];
                $saleTicketDetail->sale_ticket_id = $saleTicket->id;
                $saleTicketDetail->save();
            }
            
        }

        return response()->json();
    }

 
    public function show($userId)
    {
        $tickets = Ticket::all();
        $ticketDetails = SaleTicket::ticketDetail($userId)->get();
        foreach($ticketDetails as $index => $ticketDetail) {
            $visit = Carbon::createFromFormat('Y-m-d', $ticketDetail['visit']); // วันที่เข้ามาชม
            $today = Carbon::today(); //วันนี้

            $ticketDetails[$index]['status'] = $visit >= $today? true : false; // ถ้าวันที่เข้ามาชม มากกว่า วันนี้ให้สถานะเป็น true
            
            $ticketDetails[$index]['detail'] = SaleTicketDetail::myTicket($ticketDetail->id)->get();
            $ticketDetails[$index]['seat'] = SeatRegister::RegisterDetail($ticketDetail->id)->get();
        }
        return response()->json(['ticketDetails' => $ticketDetails, 'tickets' => $tickets]);
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
