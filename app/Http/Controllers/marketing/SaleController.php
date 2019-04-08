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
use Mpdf\Mpdf;

class SaleController extends StarterController
{
    public function __construct() {
       parent::__construct();
    }

    public function index($saleTypeName)
    {     
        $dataForSaleType = $this->setDataForSaleType($saleTypeName);
        $saleTypeId = $this->saleTypeUrl[$saleTypeName];
        $userZone = Auth::user()->employee->zone_id;
        $sales = Sale::saleDetail($this->start, $this->end, $userZone, $saleTypeId)->get();
        $data = [
            'tickets' => $this->tickets,
            'guesthouses' => Guesthouse::forSale()->get(),
            'zones' => $this->zones,
            'saleTypes' => $this->saleTypes,
            'saleTypeName' => $saleTypeName,
            'zoneSelected' => $userZone,
            'sales' => $sales,
            'range' => $this->range,
            'url' => $dataForSaleType['url'],
            'header' => $dataForSaleType['header'],
        ];
        return view('marketing._sale.index', $data);
    }
        
    public function store(Request $request)
    {
        $ticket = Ticket::find($request->ticketId);
        $sale = new Sale;
        $sale->amount = $request->amount;
        $sale->customer_name = $request->customerName;
        $sale->customer_phone = $request->customerPhone;
        $sale->customer_room = $request->customerRoom;
        $sale->guesthouse_id = $request->guesthouseId;
        $sale->sale_type = $request->saleTypeId;
        $sale->visit = $request->visitDay;
        $sale->ticket_id = $request->ticketId;
        $sale->user_id = $request->userId;
        $sale->zone_id = $request->zoneId;
        $sale->total =  $ticket['price'] * $request->amount;
        $sale->created_at = now();
        $sale->save();

        $url = $this->changeRedirect($sale->sale_type);
        return redirect($url);
    }
  
    public function edit($id)
    {
        $sale = Sale::find($id); 
        $visit =  Carbon::createFromFormat('d/m/Y',$sale->visit); // สร้าง obj ของ carbon ให้สามารถกำหนด format ของวันที่ได้
        $data = [
            'sale' => $sale,
            'tickets' => $this->tickets,
            'guesthouses' => Guesthouse::forSale()->get(),
            'saleTypes' => $this->saleTypes,
            'visit' => $visit->format('Y-m-d') // set ให้กำหนด input[type=date] ได้
        ];
        return view('marketing._sale.edit',$data);
    }

   
    public function update(Request $request, $id)
    {
    
        $ticket = Ticket::find($request->ticketId); // เอาไว้คำนวณราคาสุทธิ total
        $data = [
            'amount' => $request->amount,
            'total' =>  $ticket['price'] * $request->amount,
            'customer_name' => $request->customerName,
            'customer_phone' => $request->customerPhone,
            'customer_room' => $request->customerRoom,
            'visit' => $request->visitDay,
            'guesthouse_id' => $request->guesthouseId,
            'ticket_id' => $request->ticketId,
            'sale_type' => $request->input('saleType'),
            'user_id' => $request->userId,
        ];
        Sale::find($id)->update($data);
        $url = $this->changeRedirect($data['sale_type']);
        return redirect($url);
    }

  
    public function destroy($id)
    {
        $user = Sale::find($id);
        $user->delete();
        $url = $this->changeRedirect($user->sale_type);    
        return redirect($url);
    }

    public function search(Request $request, $saleTypeName)
    {
        $dataForSaleType = $this->setDataForSaleType($saleTypeName);
        $saleTypeId = $this->saleTypeUrl[$saleTypeName];
        $sales = Sale::saleDetail($request->start, $request->end, $request->zoneId, $saleTypeId)->get();

        $data = [
            'tickets' => $this->tickets,
            'guesthouses' => Guesthouse::forSale()->get(),
            'zones' => $this->zones,
            'saleTypes' => $this->saleTypes,
            'saleTypeName' => $saleTypeName,
            'sales' => $sales,
            'range' => ['start' => $request->start, 'end' => $request->end],
            'url' => $dataForSaleType['url'],
            'header' => $dataForSaleType['header'],
            'zoneSelected' => $request->zoneId 
        ];
        return view('marketing._sale.index', $data);
    }


}