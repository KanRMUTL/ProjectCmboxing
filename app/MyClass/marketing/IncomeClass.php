<?php 

namespace App\MyClass\marketing;

use Auth;
use App\User;
use App\marketing\Sale;
use Illuminate\Support\Facades\DB;
use App\MyClass\marketing\CalculateCommissionClass as CalCommission;

class IncomeClass {

     public $sart;
     public $end;
     public $zoneId;
     public $saleTypes = ['ปกติ', 'ขายผ่านไกด์', 'หน้า Office'];

    public function __construct($start, $end, $zoneId) {
          $this->start = $start;
          $this->end = $end;
          $this->zoneId = $zoneId;
    }

     public function getIncome() {
          if(Auth::user()->role == 1) { return $this->IncomeForAdmin(); }
          else if(Auth::user()->role == 2) { return $this->IncomeForHead(); }
          else if(Auth::user()->role == 3) { return $this->IncomeForEmployee(); }
     }

     public function IncomeForAdmin() {
          return Sale::  
                    select(
                         'user_id',
                         DB::raw('SUM(amount) AS amount'), 
                         'ticket_id', 
                         DB::raw('SUM(total) AS total'), 
                         'sale_type',
                         'created_at'
                    )
                    ->groupBy('user_id', 'ticket_id', 'sale_type', 'created_at')
                    ->orderByRaw('created_at DESC')
                    ->where(['zone_id' => $this->zoneId])
                    ->whereBetween('created_at', [$this->start, $this->end])
                    ->get();
     }

     public function IncomeForHead() {
          return Sale:: 
                    select(
                         'user_id',
                         DB::raw('SUM(amount) AS amount'), 
                         'ticket_id', 
                         DB::raw('SUM(total) AS total'), 
                         'sale_type',
                         'created_at'
                    )
                    ->groupBy('user_id', 'ticket_id', 'sale_type', 'created_at')
                    ->where(['zone_id' => $this->zoneId])
                    ->whereBetween('created_at', [$this->start, $this->end])
                    ->orderByRaw('created_at DESC')
                    ->get();
     }

     public function IncomeForEmployee() {
          return Sale::
                    select(
                         'user_id',
                         DB::raw('SUM(amount) AS amount'), 
                         'ticket_id', 
                         DB::raw('SUM(total) AS total'), 
                         'sale_type',
                         'created_at'
                    )
                    ->groupBy('user_id', 'ticket_id', 'sale_type', 'created_at')
                    ->where(['user_id' => Auth::user()->id])
                    ->whereBetween('created_at', [$this->start, $this->end])
                    ->orderByRaw('created_at DESC')
                    ->get();
     }

     public function CalculateIncome() {
          $incomes = $this->getIncome();
          foreach($incomes as $index => $item){
               $incomes[$index]['sale_type_name'] = $this->saleTypes[$item['sale_type']];
               $incomes[$index]['ticket_name'] = $item->ticket->name;
               $incomes[$index]['income'] = $this->CalculateIncomeBySaleType($item['sale_type'], $item['total'], $item['ticket_id'], $item['amount']);
               $incomes[$index]['user'] = User::find($incomes[$index]['user_id']);
           }
           return $incomes;
     }

     public function CalculateIncomeBySaleType($saleType, $total, $ticketId, $amount) {
          if($saleType == 0) 
          { // ขายบัตรแบบปกติ
              return $total - CalCommission::calEmpCommission($ticketId, $amount);
          }
          else if($saleType == 1)
          { // ขายบัตรผ่านไกด์
              return $total - CalCommission::calGuideCommission($ticketId, $amount);
          }else{ // ขายบัตรหน้าออฟฟิศ
              return $total;
          }
     }
}