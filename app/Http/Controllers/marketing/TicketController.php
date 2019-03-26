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
        $image_filename = $request->file('image')->getClientOriginalName();      
        $image_name = date('Ymd-His-').$image_filename;       
        $public_path = 'shopping/img/ticket';
        $destination =  base_path() . '/public/'. $public_path;
        $file = $request->file('image')->move($destination, $image_name);
        Ticket::create([
            'name' => $request->name,
            'price' => $request->price,
            'img' => $image_name
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
        if($request->hasFile('image')){ 
            $oldImagePath =  'shopping\img\ticket\\'.$ticket->img;
            unlink(public_path($oldImagePath));
            $image_filename = $request->file('image')->getClientOriginalName();       
            $image_name = date('Ymd-His-').$image_filename;       
            $public_path = 'shopping/img/ticket';       
            $destination = base_path() . "/public/" . $public_path;      
            $request->file('image')->move($destination, $image_name); 
            $ticket->update([
                'name' => $request->name,
                'price' => $request->price,
                'img' => $image_name
            ]);
        }
        else 
        {
            $ticket->update(
                [
                    'name' => $request->name,
                    'price' => $request->price
                ]
            );
        } 
        return redirect('/ticket');
    }

    public function destroy($id)
    {
        $imagePath =  'shopping\img\ticket\\';
        $ticket = Ticket::find($id);
        unlink(public_path($imagePath.$ticket->img));
        $ticket->delete();
        return redirect('/ticket');
    }
}
