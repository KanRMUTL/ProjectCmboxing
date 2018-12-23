<?php

namespace App\Http\Controllers\marketing;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\marketing\Sale;
use App\marketing\Ticket;
use Carbon\Carbon;
use Auth;

class CommissionController extends Controller
{
    public function empCommission()
    {
        $now = Carbon::now();
        $start =  $now->startOfWeek()->format('Y-m-d');
        $end = $now->endOfWeek()->format('Y-m-d');

        $data = $this->getCommission($start, $end);
        $range = [
            'start' => $start,
            'end' => $end
        ];
        return view('_commission.index')
                ->with('data', $data)
                ->with('range', $range);
    }

    public function searchCommission(Request $request)
    {   
        $start = $request->start;
        $end = $request->end;
        
        $data = $this->getCommission($start, $end);
        $range = [
            'start' => $start,
            'end' => $end
        ];

        return view('_commission.index')
                ->with('data', $data)
                ->with('range', $range);
    }

    private function getCommission($start, $end)
    {
        if(Auth::user()->role_id == 1)
        {
            $data = Sale::commissionForAdmin($start, $end)->get();
        }
        else if(Auth::user()->role_id == 2)
        {
            $data = Sale::commissionForHead()->get();
        }
        else if(Auth::user()->role_id == 3)
        {
            $data = Sale::commissionForEmp()->get();
        }
        // เพิ่ม ชื่อผู้ใช้  ชื่อบัตร  คำนวณค่าคอมมิดชั่น              
        $index = 0;
        foreach ($data as $item) {  
            $data[$index]['commission'] = $this->calculationCommission($item->ticket_id, $item->amount);
            $data[$index]['date_formated'] = Carbon::parse($item->created_at)->format('d/m/Y');
            $index++;
        }

        return $data;
    }

    private function calculationCommission($ticketId, $amount)
    {

        if($ticketId == 1)  // Grandstand
        {
            $ticket = Ticket::get();
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
            $ticket = Ticket::get();
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
            $ticket = Ticket::get();
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
}
