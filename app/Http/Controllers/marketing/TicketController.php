<?php

namespace App\Http\Controllers\marketing;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\marketing\Ticket;
class TicketController extends Controller
{
   
    public function index()
    {
        $data = [
            'tickets' => Ticket::all()
        ];
        return view('_ticket.index', $data);
    }

  
    public function store(Request $request)
    {
        Ticket::create([
            'name' => $request->name,
            'price' => $request->price
        ]);
        return redirect('/ticket');
    }
    
    public function edit($id)
    {
        $data = [
            'ticket' => Ticket::find($id)
        ];
        return view('_ticket.edit',$data);
    }
  
    public function update(Request $request, $id)
    {
        $ticket = Ticket::find($id);
        $ticket->update([
            'name' => $request->name,
            'price' => $request->price
        ]);
        return redirect('/ticket');
    }

    public function destroy($id)
    {
        $ticket = Ticket::find($id);
        $ticket->delete();
    }
}
