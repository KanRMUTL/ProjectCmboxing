<?php 

namespace App\MyClass;

use Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\marketing\Sale;
use App\MyClass\CalculateCommissionClass;

class CommissionClass extends CalculateCommissionClass {

    public $start;
    public $end;
    public $zoneId;
    public $saleTypeId;

    public function __construct($start, $end, $zoneId, $saleTypeId) {
        $this->start = $start;
        $this->end = $end;
        $this->zoneId = $zoneId;
        $this->saleTypeId = $saleTypeId;
    }

    public function Commission()
    {
        if(Auth::user()->role == 1){ 
            return $this->CommissionForAdmin();
        }
        else if(Auth::user()->role == 2) { // หัวหน้าฝ่ายการตลาด
            return $this->CommissionForHead();
        }
        else if(Auth::user()->role == 3){ // พนักงาน
            return $this->CommissionForEmployee();
        }
    }

    // Employee
    public function getCommissionOfEmp()
    {
        $data = $this->Commission();
        foreach ($data as $index => $item) {  
            $data[$index]['commission'] = $this->calEmpCommission($item->ticket_id, $item->amount);
            $data[$index]['date_formated'] = Carbon::parse($item->created_at)->format('d/m/Y');
        }
        return $data;
    }

    public function CommissionForAdmin() {
        return Sale::
                select(
                    'user_id', 
                    DB::raw('SUM(amount) as amount'), 
                    'ticket_id',                      
                    DB::raw('DATE(created_at) as date_created_at')
                )
                ->where([
                    ['zone_id', '=', $this->zoneId],
                    ['sale_type', '=', $this->saleTypeId]
                ])
                ->whereBetween('created_at', [$this->start, $this->end])
                ->groupBy('date_created_at', 'user_id', 'ticket_id')
                ->orderByRaw('created_at DESC')
                ->get();
    }

    public function CommissionForHead() {
        return Sale::
                select(
                    'user_id', 
                    DB::raw('SUM(amount) as amount'), 
                    'ticket_id',
                    'created_at'                        
                )
                ->where([
                    ['zone_id', '=',  Auth::user()->employee->zone_id],
                    ['sale_type', '=', $this->saleTypeId]    
                ])
                ->whereBetween('created_at', [$this->start, $this->end])
                ->groupBy('user_id','created_at', 'ticket_id')
                ->orderByRaw('created_at DESC')
                ->get();
    }

    public function CommissionForEmployee() {
        return $query
                ->select(
                    'user_id', 
                    DB::raw('SUM(amount) as amount'), 
                    'ticket_id',                      
                    'created_at'
                )
                ->where([
                    ['user_id', '=', Auth::user()->id],
                    ['sale_type', '=', $this->saleTypeId]    
                ])
                ->whereBetween('created_at', [$this->start, $this->end])
                ->groupBy('user_id','created_at', 'ticket_id')
                ->orderByRaw('created_at DESC')
                ->get();
    }

    //    Guide
    public function guideCommission()
    {
        $data['commission'] = $this->getCommissionOfGuide();
        $data['range'] = $this->range;
        $data['zones'] = $this->zones;
        $data['zoneSelected'] = $userZone;
        return view('marketing._commission.guide', $data);
    }

    public function getCommissionOfGuide()
    {
        $data = $this->Commission();
        foreach($data as $index => $item){
            $data[$index]['commission'] = $this->calGuideCommission($item->ticket_id, $item->amount);
            $data[$index]['date_formated'] = Carbon::parse($item->created_at)->format('d/m/Y');
        }
        return $data;
    }

}