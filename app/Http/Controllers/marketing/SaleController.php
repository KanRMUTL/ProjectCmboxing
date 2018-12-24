<?php

namespace App\Http\Controllers\marketing;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Users;
use Auth;
use App\marketing\Sale;
use App\marketing\Zone;
use App\marketing\Ticket;
use App\marketing\Guesthouse;
use Carbon\Carbon;

class SaleController extends Controller
{
    
    
    public function index()
    {
        $tickets = Ticket::all();
        $guesthouses = Guesthouse::forSale()->get();
        $zones = Zone::all();
        $now = Carbon::now();
        $start =  $now->startOfWeek()->format('Y-m-d');
        $end = $now->endOfWeek()->format('Y-m-d');
        $range = [
            'start' => $start,
            'end' => $end
        ];
        $userZone = Auth::user()->zone_id;
        $sales = Sale::sale($start, $end, $userZone)->get();
        $data = [
            'tickets' => $tickets,
            'guesthouses' => $guesthouses,
            'zones' => $zones,
            'zoneSelected' => $userZone,
            'sales' => $sales,
            'range' => $range
        ];
        
        return view('_sale.index', $data);
    }
    
    public function searchSale(Request $request)
    {
        $start = $request->start;
        $end = $request->end;
        $zoneId = $request->zoneId;
        $range = [
            'start' => $start,
            'end' => $end
        ];
        
        $sales = Sale::sale($start, $end, $zoneId)->get();
        $tickets = Ticket::all();
        $zones = Zone::all();
        $guesthouses = Guesthouse::forSale()->get();

        $data = [
            'tickets' => $tickets,
            'guesthouses' => $guesthouses,
            'zones' => $zones,
            'sales' => $sales,
            'range' => $range,
            'zoneSelected' => $zoneId 
        ];

        return view('_sale.index', $data);
    }
   
    public function store(Request $request)
    {
        $ticket = Ticket::find($request->ticketId);
        $data = [
            'amount' => $request->amount,
            'customer_name' => $request->customerName,
            'customer_phone' => $request->customerPhone,
            'customer_room' => $request->customerRoom,
            'guesthouse_id' => $request->guesthouseId,
            'visit' => $request->visitDay,
            'ticket_id' => $request->ticketId,
            'user_id' => $request->userId,
            'zone_id' => $request->zoneId,
            'total' =>  $ticket['price'] * $request->amount
        ];
        Sale::create($data);
        return redirect('sale');
    }
  
    public function edit($id)
    {
        $sale = Sale::find($id); 
        $tickets = Ticket::get();
        $guesthouses = Guesthouse::forSale()->get(); 
        $visit =  Carbon::createFromFormat('d/m/Y',$sale->visit); // สร้าง obj ของ carbon ให้สามารถกำหนด format ของวันที่ได้
        $data = [
            'sale' => $sale,
            'tickets' => $tickets,
            'guesthouses' => $guesthouses,
            'visit' => $visit->format('Y-m-d') // set ให้กำหนด input[type=date] ได้
        ];
        return view('_sale.edit',$data);
    }

   
    public function update(Request $request, $id)
    {
        $ticket = Ticket::find($request->ticketId);
        $data = [
            'amount' => $request->amount,
            'customer_name' => $request->customerName,
            'customer_phone' => $request->customerPhone,
            'customer_room' => $request->customerRoom,
            'guesthouse_id' => $request->guesthouseId,
            'visit' => $request->visitDay,
            'ticket_id' => $request->ticketId,
            'user_id' => $request->userId,
            'total' =>  $ticket['price'] * $request->amount
        ];
        
        Sale::find($id)->update($data);
        return redirect('sale');
    }

  
    public function destroy($id)
    {
        $user = Sale::find($id);
        $user->delete();
        return redirect('/sale');
    }
}
