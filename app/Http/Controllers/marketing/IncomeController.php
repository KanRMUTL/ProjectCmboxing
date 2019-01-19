<?php

namespace App\Http\Controllers\marketing;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\marketing\SaleController;
use App\marketing\Sale;
use App\Http\Controllers\marketing\CommissionController;
use App\Http\Controllers\marketing\StarterController;

class IncomeController extends StarterController
{

    protected $commission = CommissionController::class;

    public function income()
    {
        $data = Sale::select('amount', 'ticket_id', 'total', 'sale_type_id')->get();
        foreach($data as $index => $item){
            $data[$index]['income'] = $this->calIncome($item['sale_type_id'], $item['total'], $item['ticket_id'], $item['amount']);
            $data[$index]['sale_type_name'] = $item->saleType->name;
            $data[$index]['ticket_name'] = $item->ticket->name;
            $data[$index]['commission'] = CommissionController::calEmpCommission($item->ticket_id, $item->amount);
        }
        return $data;
    }

    public function calIncome($saleType, $total, $ticketId, $amount)
    {
        if($saleType == 1) 
        {
            return $total - CommissionController::calEmpCommission($ticketId, $amount);
        }
        else if($saleType == 2)
        {
            return $total - CommissionController::calGuideCommission($ticketId, $amount);
        }else{
            return $total;
        }
    }
}
