<?php

namespace App\Http\Controllers\marketing;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\marketing\Ticket;
use App\marketing\GuideCommission;
use App\MyClass\pos\ImageClass;
use App\Http\Requests\marketing\TicketMuayThaiRequest;

class TicketController extends Controller
{
   
    public function index()
    {
        $data = [
            'tickets' => Ticket::joinGuideCommission()->get()
        ];
        return view('marketing.admin.menu._ticket.index', $data);
    }

    public function store(Request $request)
    {        
        $objImage = new ImageClass('ticket', $request->file('image'));
        $objImage->uploadImage();

        $ticket = new Ticket();
        $ticket->name = $request->name;
        $ticket->price = $request->price;
        $ticket->img =  $objImage->imageName;
        $ticket->save();
    
        GuideCommission::create([
            'commission' => $request->input('commission'),
            'ticket_id' => $ticket->id
        ]);
        return redirect('/ticket');
    }
    
    public function edit($id)
    {
        $data = [
            'ticket' => Ticket::joinGuideCommission()->find($id)
        ];
        return view('marketing.admin.menu._ticket.edit',$data);
    }
  
    public function update(TicketMuayThaiRequest $request, $id)
    {
        $ticket = Ticket::find($id);
        
        if($request->hasFile('image')){ 
            $objImage = new ImageClass('ticket', $request->file('image'));
            $objImage->originalName = $ticket->img;
            $objImage->updateImage();
            $ticket->update([
                'name' => $request->name,
                'price' => $request->price,
                'img' => $objImage->imageName
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
        GuideCommission::where('ticket_id', $id)->update(['commission' => $request->commission]);
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
