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
use App\marketing\SaleType;
use Carbon\Carbon;
use App\Http\Controllers\marketing\StarterController;
class SaleController extends StarterController
{
    public function __construct(){
       parent::__construct();
    }

    public function index($saleTypeName)
    {       
        $dataForSaleType = $this->setDataForSaleType($saleTypeName);
        $saleTypeId = $this->saleTypeUrl[$saleTypeName];
        $guesthouses = Guesthouse::forSale()->get();
        $userZone = Auth::user()->zone_id;
        $sales = Sale::saleDetail($this->start, $this->end, $userZone, $saleTypeId)->get();
        $data = [
            'tickets' => $this->tickets,
            'guesthouses' => $guesthouses,
            'zones' => $this->zones,
            'saleTypes' => $this->saleTypes,
            'zoneSelected' => $userZone,
            'sales' => $sales,
            'range' => $this->range,
            'url' => $dataForSaleType['url'],
            'header' => $dataForSaleType['header'],
        ];
            return view('_sale.index', $data);
    }
        
    public function search(Request $request, $saleTypeName)
    {
        $dataForSaleType = $this->setDataForSaleType($saleTypeName);
        $saleTypeId = $this->saleTypeUrl[$saleTypeName];
        $start = $request->start;
        $end = $request->end;
        $zoneId = $request->zoneId;
        $range = [
            'start' => $start,
            'end' => $end
        ];
        
        $sales = Sale::saleDetail($start, $end, $zoneId, $saleTypeId)->get();
        $guesthouses = Guesthouse::forSale()->get();

        $data = [
            'tickets' => $this->tickets,
            'guesthouses' => $guesthouses,
            'zones' => $this->zones,
            'saleTypes' => $this->saleTypes,
            'sales' => $sales,
            'range' => $range,
            'url' => $dataForSaleType['url'],
            'header' => $dataForSaleType['header'],
            'zoneSelected' => $zoneId 
        ];

        return view('_sale.index', $data);
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
        $sale->sale_type_id = $request->saleTypeId;
        $sale->visit = $request->visitDay;
        $sale->ticket_id = $request->ticketId;
        $sale->user_id = $request->userId;
        $sale->zone_id = $request->zoneId;
        $sale->total =  $ticket['price'] * $request->amount;
        $sale->created_at = now();
        $sale->save();

        $url = $this->changeRedirect($sale->sale_type_id);
        return redirect($url);
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
            'saleTypes' => $this->saleTypes,
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
            'sale_type_id' => $request->saleTypeId,
            'total' =>  $ticket['price'] * $request->amount
        ];
        
        Sale::find($id)->update($data);
        $url = $this->changeRedirect($data['sale_type_id']);
        return redirect($url);
    }

  
    public function destroy($id)
    {
        $user = Sale::find($id);
        $user->delete();
        $url = $this->changeRedirect($user->sale_type_id);    
        return redirect($url);
    }

}