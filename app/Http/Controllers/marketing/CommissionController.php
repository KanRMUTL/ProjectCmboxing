<?php

namespace App\Http\Controllers\marketing;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\marketing\Sale;
use App\marketing\Ticket;
use App\marketing\Zone;
use App\marketing\GuideCommission;
use Carbon\Carbon;
use Auth;
use App\Http\Controllers\marketing\StarterController;

class CommissionController extends StarterController
{
    public function __construct()
    {
       parent::__construct();        
    }

    public function empCommission()
    {
        $userZone = Auth::user()->zone_id;
        $data = $this->getCommissionOfEmp($this->start, $this->end, $userZone);
        return view('_commission.emp')
                ->with('data', $data)
                ->with('range', $this->range)
                ->with('zones', $this->zones)
                ->with('zoneSelected', $userZone);
    }

    public function searchEmp(Request $request)
    {   
        $start = $request->start;
        $end = $request->end;
        $zoneId = $request->zoneId;
        $data = $this->getCommissionOfEmp($start, $end, $zoneId);
        $range = [
            'start' => $start,
            'end' => $end
        ];

        return view('_commission.emp')
                ->with('data', $data)
                ->with('range', $range)
                ->with('zoneSelected', $zoneId)
                ->with('zones', $this->zones);
    }

    private function getCommissionOfEmp($start, $end, $zoneId)
    {
        $data = Sale::commission($start, $end, $zoneId, 1)->get();
              
        foreach ($data as $index => $item) {  
            $data[$index]['commission'] = $this->calEmpCommission($item->ticket_id, $item->amount);
            $data[$index]['date_formated'] = Carbon::parse($item->created_at)->format('d/m/Y');
        }

        return $data;
    }

   
    private function calEmpCommission($ticketId, $amount)
    {
        if($ticketId == 1)  // Grandstand
        {
            if($amount <= 10)
            {
                return $amount * 20;
            }
            else if($amount <= 20)
            {
                return $amount * 30;
            }
            else if($amount <= 30)
            {
                return $amount * 40;
            }
            else{
                return $amount * 50;
            }
        }
        else if($ticketId == 2)  // RingSide
        {
            if($amount <= 10)
            {
                return $amount * 20;
            }
            else if($amount <= 30)
            {
                return $amount * 40;
            }
            else if($amount <= 30)
            {
                return $amount * 60;
            }
            else{
                return $amount * 80;
            }
        }
        else if($ticketId == 3)  // VIP
        {
            if($amount <= 10)
            {
                return $amount * 50;
            }
            else if($amount <= 20)
            {
                return $amount * 70;
            }
            else if($amount <= 30)
            {
                return $amount * 100;
            }
            else{
                return $amount * 130;
            }
        }
    }
    
    public function guideCommission()
    {
        $userZone = Auth::user()->zone_id;
        $data = $this->getCommissionOfGuide($this->start, $this->end, $userZone);
        return view('_commission.guide')
        ->with('data', $data)
        ->with('range', $this->range)
        ->with('zones', $this->zones)
        ->with('zoneSelected', $userZone);
    }

    private function getCommissionOfGuide($start, $end, $zoneId)
    {
        $data = Sale::commission($start, $end, $zoneId, 2)->get();
        foreach($data as $index => $item){
            $data[$index]['commission'] = $this->calGuideCommission($item->ticket_id, $item->amount);
            $data[$index]['date_formated'] = Carbon::parse($item->created_at)->format('d/m/Y');
        }
        return $data;
    }

    private function calGuideCommission($ticketId, $amount)
    {
       $commission = GuideCommission::where('ticket_id', '=', $ticketId)->get();
       return $commission[0]->commission * $amount;
    }
}
