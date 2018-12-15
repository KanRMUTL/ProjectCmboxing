<?php

namespace App\Http\Controllers\marketing;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Users;
use App\marketing\Sale;
use App\marketing\Zone;
use App\marketing\Ticket;
use App\marketing\Guesthouse;

class SaleController extends Controller
{
    
    public function index()
    {
        $tickets = Ticket::all();
        $guesthouses = Guesthouse::forSale()->get();
        $sales = Sale::all();

        // dd($sales[0]->guesthouse);
        $data = [
            'tickets' => $tickets,
            'guesthouses' => $guesthouses,
            'sales' => $sales
        ];
        
        return view('_sale.index',$data);
    }

   
    public function create()
    {
        //
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
            'total' =>  $ticket['price'] * $request->amount
        ];
        Sale::create($data);
        return redirect('sale');
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
