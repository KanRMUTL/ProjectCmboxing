<?php

namespace App\Http\Controllers\marketing;

use Illuminate\Http\Request;
use Auth;
use App\marketing\Sale;
use App\marketing\Ticket;
use App\marketing\Guesthouse;
use App\Http\Controllers\LineNotify;
use Carbon\Carbon;
use App\Http\Controllers\marketing\StarterController;
use App\Http\Requests\marketing\TicketRequest;
use Mpdf\Mpdf;
use App\MyClass\marketing\SaleClass;

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
        $sales = new SaleClass($this->start, $this->end, $userZone, $saleTypeId);
        
        $data = [
            'tickets' => $this->tickets,
            'guesthouses' => Guesthouse::forSale()->get(),
            'zones' => $this->zones,
            'saleTypes' => $this->saleTypes,
            'saleTypeName' => $saleTypeName,
            'zoneSelected' => $userZone,
            'range' => $this->range,
            'url' => $dataForSaleType['url'],
            'header' => $dataForSaleType['header'],
        ];
        $data['sales'] = $sales->SearchSale();
        
        return view('marketing._sale.index', $data);
    }
        
    public function store(TicketRequest $request)
    {
        $ticket = Ticket::find($request->ticketId);
        $sale = new Sale;
        $sale->amount = $request->amount;
        $sale->customer_name = $request->customerName;
        $sale->customer_phone = $request->customerPhone;

        if($request->saleTypeId == 3) {
            $sale->customer_room = 0;
            $sale->guesthouse_id = 0;
        } else {
            $sale->customer_room = $request->customerRoom;
            $sale->guesthouse_id = $request->guesthouseId;
        }

        $sale->sale_type = $request->saleTypeId;
        $sale->visit = $request->visitDay;
        $sale->ticket_id = $request->ticketId;
        $sale->user_id = $request->userId;
        $sale->zone_id = $request->zoneId;
        $sale->total =  $ticket['price'] * $request->amount;
        $sale->created_at = now();
        $sale->save();
        $lineNotify = new LineNotify();
        $lineNotify->notify($sale);

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

   
    public function update(TicketRequest $request, $id)
    {
        $ticket = Ticket::find($request->ticketId); // เอาไว้คำนวณราคาสุทธิ total
        // return $request;
        $data = [
            'amount' => $request->amount,
            'total' =>  $ticket['price'] * $request->amount,
            'customer_name' => $request->customerName,
            'customer_phone' => $request->customerPhone,
            'customer_room' => $request->customerRoom,
            'visit' => $request->visitDay,
            'guesthouse_id' => $request->guesthouseId,
            'ticket_id' => $request->ticketId,
            'sale_type' => $request->saleTypeId,
            'user_id' => $request->userId,
        ];
        $sale = Sale::find($id);
        $sale->update($data);
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
        $sales = new SaleClass($request->start, $request->end, $request->zoneId, $saleTypeId);
 
        $data = [
            'tickets' => $this->tickets,
            'guesthouses' => Guesthouse::forSale()->get(),
            'zones' => $this->zones,
            'saleTypes' => $this->saleTypes,
            'saleTypeName' => $saleTypeName,
            'range' => ['start' => $request->start, 'end' => $request->end],
            'url' => $dataForSaleType['url'],
            'header' => $dataForSaleType['header'],
            'zoneSelected' => $request->zoneId 
        ];
        $data['sales'] = $sales->SearchSale();
        
        return view('marketing._sale.index', $data);
    }

    public function employeeProfile($id) {
        $data['id'] = $id;
        return view('marketing._profile.index', $data);
    }
}