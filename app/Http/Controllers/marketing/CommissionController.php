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
        $userZone =  Auth::user()->employee->zone_id;
        $data['commission'] = $this->getCommissionOfEmp($this->start, $this->end, $userZone);
        $data['range'] = $this->range;
        $data['zones'] = $this->zones;
        $data['zoneSelected'] = $userZone;
        return view('marketing._commission.emp', $data);
    }

    public function searchEmp(Request $request)
    {   
        $data['range'] = ['start' => $request->start,'end' => $request->end];
        $data['commission'] = $this->getCommissionOfEmp($request->start,$request->end, $request->zoneId);
        $data['zones'] = $this->zones;
        $data['zoneSelected'] = $request->zoneId;
        return view('marketing._commission.emp', $data);
    }
    public function searchGuide(Request $request)
    {   
        $start = $request->start;
        $end = $request->end;
        $zoneId = $request->zoneId;
       
        $data['range'] = ['start' => $request->start, 'end' => $request->end];
        $data['commission'] = $this->getCommissionOfGuide($request->start, $request->end, $request->zoneId);
        $data['zoneSelected'] = $request->zoneId;
        $data['zones'] = $this->zones;
        return view('marketing._commission.guide', $data);
    }

    public function guideCommission()
    {
        $userZone =  Auth::user()->employee->zone_id;
        $data['commission'] = $this->getCommissionOfGuide($this->start, $this->end, $userZone);
        $data['range'] = $this->range;
        $data['zones'] = $this->zones;
        $data['zoneSelected'] = $userZone;
        return view('marketing._commission.guide', $data);
    }

    public function getCommissionOfEmp($start, $end, $zoneId)
    {
        $data = Sale::commission($start, $end, $zoneId, 1)->get();
        foreach ($data as $index => $item) {  
            $data[$index]['commission'] = $this->calEmpCommission($item->ticket_id, $item->amount);
            $data[$index]['date_formated'] = Carbon::parse($item->created_at)->format('d/m/Y');
        }
        return $data;
    }

    public static function calEmpCommission($ticketId, $amount)
    {
        $total = 0;
        
        if($amount <= 10){  // คิดค่าคอมมิชชั่นการขายบัตร 1-10 ใบ
            $total += self::calFirst($ticketId, $amount);
        }
        else if($amount <= 20){  // คิดค่าคอมมิชชั่นการขายบัตร 1-20 ใบ
            $realAmount = $amount - 10;
            $total += self::calSecond($ticketId, $realAmount);
            $total += self::calFirst($ticketId, 10);
        }
        else if($amount <= 30){ // คิดค่าคอมมิชชั่นการขายบัตร 1-30 ใบ
            $realAmount = $amount - 20;
            $total += self::calThird($ticketId, $realAmount);
            $total += self::calSecond($ticketId, 10);
            $total += self::calFirst($ticketId, 10);
        }
        else if($amount > 30){  // คิดค่าคอมมิชชั่นการขายบัตรมากกว่า 30 ใบ
            $realAmount = $amount - 30;
            $total += self::calFour($ticketId, $realAmount);
            $total += self::calThird($ticketId, 10);
            $total += self::calSecond($ticketId, 10);
            $total += self::calFirst($ticketId, 10);
        }
        return $total;
    }

    public static function calFirst($ticketId, $amount)
    {
        if($ticketId == 1){
            return 20 * $amount;
        }
        else if($ticketId == 2){
            return 30 * $amount;
        }
        else if($ticketId == 3){
            return 50 * $amount;
        }
    }

    public static function calSecond($ticketId, $amount)
    {
        if($ticketId == 1){
            return 30 * $amount;
        }
        else if($ticketId == 2){
            return 40 * $amount;
        }
        else if($ticketId == 3){
            return 70 * $amount;
        }
    }

    public static function calThird($ticketId, $amount)
    {
        if($ticketId == 1){
            return 40 * $amount;
        }
        else if($ticketId == 2){
            return 60 * $amount;
        }
        else if($ticketId == 3){
            return 100 * $amount;
        }
    }
    
    public static function calFour($ticketId, $amount)
    {
        if($ticketId == 1){
            return 50 * $amount;
        }
        else if($ticketId == 2){
            return 80 * $amount;
        }
        else if($ticketId == 3){
            return 130 * $amount;
        }
    }   

    public function getCommissionOfGuide($start, $end, $zoneId)
    {
        $data = Sale::commission($start, $end, $zoneId, 2)->get();
        foreach($data as $index => $item){
            $data[$index]['commission'] = $this->calGuideCommission($item->ticket_id, $item->amount);
            $data[$index]['date_formated'] = Carbon::parse($item->created_at)->format('d/m/Y');
        }
        return $data;
    }

    public static function calGuideCommission($ticketId, $amount)
    {
       $commission = GuideCommission::where('ticket_id', '=', $ticketId)->get();
       return $commission[0]->commission * $amount;
    }
}
