<?php

namespace App\Http\Controllers\marketing;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\marketing\Sale;
use App\marketing\Ticket;

class CommissionController extends Controller
{
    public function empCommission()
    {
        $data = Sale::
                    select(
                        'user_id', 
                        DB::raw('SUM(amount) as amount'), 
                        'ticket_id'                        
                    )
                    ->groupBy('ticket_id', 'created_at', 'user_id')
                    ->orderBy('created_at')
                    ->get();

        // เพิ่ม ชื่อผู้ใช้  ชื่อบัตร  คำนวณค่าคอมมิดชั่น              
        $index = 0;
        foreach ($data as $item) {  
            $data[$index]['user_name'] = $item->user->name;
            $data[$index]['ticket_price'] = $item->ticket->price;
            $data[$index]['commission'] = $this->calculationCommission($item->ticket_id, $item->amount);
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
