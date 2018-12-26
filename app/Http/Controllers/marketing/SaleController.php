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
    protected $tickets;
    protected $zones;
    protected $now;
    protected $range;
    protected $start;
    protected $end;

    public function __construct(){
        $this->tickets = Ticket::all();
        $this->zones = Zone::all();
        $this->now = Carbon::now();
        $this->start =  $this->now->startOfWeek()->format('Y-m-d');
        $this->end = $this->now->endOfWeek()->format('Y-m-d');
        $this->range = [
            'start' => $this->start,
            'end' => $this->end
        ];
    }

    public function getByEmployee()
    {       
        $guesthouses = Guesthouse::forSale()->get();
        $userZone = Auth::user()->zone_id;
        $sales = Sale::saleEmp($this->start, $this->end, $userZone)->get();
        $data = [
            'tickets' => $this->tickets,
            'guesthouses' => $guesthouses,
            'zones' => $this->zones,
            'zoneSelected' => $userZone,
            'sales' => $sales,
            'range' => $this->range
        ];
        
        return view('_sale.by_employee', $data);
    }
    
    public function searchByEmployee(Request $request)
    {
        $start = $request->start;
        $end = $request->end;
        $zoneId = $request->zoneId;
        $range = [
            'start' => $start,
            'end' => $end
        ];
        
        $sales = Sale::saleEmp($start, $end, $zoneId)->get();
        $guesthouses = Guesthouse::forSale()->get();

        $data = [
            'tickets' => $this->tickets,
            'guesthouses' => $guesthouses,
            'zones' => $this->zones,
            'sales' => $sales,
            'range' => $range,
            'zoneSelected' => $zoneId 
        ];

        return view('_sale.by_employee', $data);
    }
   
    public function store(Request $request)
    {
        $ticket = Ticket::find($request->ticketId);
        $sale = new Sale;
        $sale->amount = $request->amount;
        $sale->amount = $request->amount;
        $sale->customer_name = $request->customerName;
        $sale->customer_phone = $request->customerPhone;
        $sale->customer_room = $request->customerRoom;
        $sale->guesthouse_id = $request->guesthouseId;
        $sale->sale_type = $request->saleType;
        $sale->visit = $request->visitDay;
        $sale->ticket_id = $request->ticketId;
        $sale->user_id = $request->userId;
        $sale->zone_id = $request->zoneId;
        $sale->total =  $ticket['price'] * $request->amount;
        $sale->save();
        return redirect('/saleByEmployee');
    }
  
    public function edit($id)
    {
        $sale = Sale::find($id); 
        $tickets = Ticket::get();
        $guesthouses = Guesthouse::forSale()->get(); 
        $visit =  Carbon::createFromFormat('d/m/Y',$sale->visit); // สร้าง obj ของ carbon ให้สามารถกำหนด format ของวันที่ได้
        $data = [
            'sale' => $sale,
            'tickets' => $this->tickets,
            'guesthouses' => $guesthouses,
            'visit' => $visit->format('Y-m-d') // set ให้กำหนด input[type=date] ได้
        ];
        return view('_sale.edit',$data);
    }

   
    public function update(Request $request, $id)
    {
        $ticket = Ticket::find($request->ticketId); // เอาไว้คำนวณราคาสุทธิ total
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
        return redirect('/saleByEmployee');
    }

  
    public function destroy($id)
    {
        $user = Sale::find($id);
        $user->delete();
        return redirect('/saleByEmployee');
    }
}
