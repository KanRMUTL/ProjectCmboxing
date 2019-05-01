<?php 

namespace App\MyClass\marketing;

use Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\marketing\Sale;
use App\MyClass\marketing\CalculateCommissionClass;

class CommissionClass extends CalculateCommissionClass {

    public $start;
    public $end;
    public $zoneId;
    public $saleTypeId;
    public $userId;

    public function __construct($start, $end, $zoneId, $saleTypeId, $userId) {
        $this->start = $start;
        $this->end = $end;
        $this->zoneId = $zoneId;
        $this->saleTypeId = $saleTypeId;
        $this->userId = null ? null : $userId;
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
            $data[$index]['commission'] = parent::calEmpCommission($item->ticket_id, $item->amount);
            $data[$index]['date_formated'] = Carbon::parse($item->created_at)->format('d/m/Y');
        }
        return $data;
    }
    public function getCommissionEmpProfile()
    {
        $data['list'] = $this->CommissionForEmployee();
        $total = 0;
        foreach ($data['list'] as $index => $item) {  
            $data['list'][$index]['commission'] = parent::calEmpCommission($item->ticket_id, $item->amount);
            $data['list'][$index]['date_formated'] = Carbon::parse($item->created_at)->format('d/m/Y');
            $total += $data['list'][$index]['commission'];
        }
        $data['total'] = $total;
        return $data;
    }

    public function CommissionForAdmin() {
        return Sale::
                join('users', 'sales.user_id', '=', 'users.id')
                ->select(
                    'user_id', 
                    DB::raw('SUM(amount) as amount'), 
                    'ticket_id',                      
                    DB::raw('DATE(created_at) as date_created_at')
                )
                ->where([
                    ['zone_id', '=', $this->zoneId],
                    ['sale_type', '=', $this->saleTypeId]
                ])
                ->whereBetween(DB::raw('DATE(created_at)'), [DB::raw(DATE($this->start)), DB::raw(DATE($this->end))])
                ->groupBy('date_created_at', 'user_id', 'ticket_id')
                ->orderByRaw('created_at DESC')
                ->get();
    }

    public function CommissionForHead() {
        return Sale::
                join('users', 'sales.user_id', '=', 'users.id')
                ->select(
                    'user_id', 
                    DB::raw('SUM(amount) as amount'), 
                    'ticket_id',                      
                    DB::raw('DATE(created_at) as date_created_at')
                )
                ->where([
                    ['zone_id', '=',  Auth::user()->employee->zone_id],
                    ['sale_type', '=', $this->saleTypeId]    
                ])
                ->whereBetween(DB::raw('DATE(created_at)'), [DB::raw(DATE($this->start)), DB::raw(DATE($this->end))])
                ->groupBy('date_created_at', 'user_id', 'ticket_id')
                ->orderByRaw('created_at DESC')
                ->get();
    }

    public function CommissionForEmployee() {
        return Sale::
                join('users', 'sales.user_id', '=', 'users.id')
                ->join('tickets', 'sales.ticket_id', '=', 'tickets.id')
                ->select(
                    'user_id', 
                    DB::raw('SUM(amount) as amount'), 
                    'ticket_id',                      
                    'tickets.name as ticket_name',
                    DB::raw('DATE(created_at) as date_created_at')
                )
                ->where([
                    ['user_id', '=', $this->userId],
                    ['sale_type', '=', $this->saleTypeId]    
                ])
                ->whereBetween(DB::raw('DATE(created_at)'), [DB::raw(DATE($this->start)), DB::raw(DATE($this->end))])
                ->groupBy('date_created_at', 'user_id', 'ticket_id')
                ->orderByRaw('created_at DESC')
                ->get();
    }

    //    Guide

    public function getCommissionOfGuide()
    {
        $data = $this->Commission();
        foreach($data as $index => $item){
            $data[$index]['commission'] = parent::calGuideCommission($item->ticket_id, $item->amount);
            $data[$index]['date_formated'] = Carbon::parse($item->created_at)->format('d/m/Y');
        }
        return $data;
    }
    public function getCommissionGuideProfile()
    {
        $data['list'] = $this->CommissionForEmployee();
        $total = 0;
        $customer = 0;
        foreach($data['list'] as $index => $item){
            $data['list'][$index]['commission'] = parent::calGuideCommission($item->ticket_id, $item->amount);
            $data['list'][$index]['date_formated'] = Carbon::parse($item->created_at)->format('d/m/Y');
            $total += $data['list'][$index]['commission'];
            $customer += $item['amount'];
        }
        $data['total'] = $total;
        $data['customer'] = $customer;
        return $data;
    }

}