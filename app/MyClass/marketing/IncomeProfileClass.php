<?php 

namespace App\MyClass\marketing;

use App\MyClass\marketing\IncomeClass;
use Carbon\Carbon;
use App\User;

class IncomeProfileClass extends IncomeClass {

     public $user_id;

     public function __construct($start, $end, $user_id) {
          $this->start = $start;
          $this->end = $end;
          $this->user_id = $user_id;
     }

     public function CalculateIncomeProfile() {
          $incomes['list'] = $this->IncomeForEmployee($this->user_id);
          $total = 0;
          $customer = 0;
          foreach($incomes['list'] as $index => $item){
               $incomes['list'][$index]['sale_type_name'] = $this->saleTypes[$item['sale_type']];
               $incomes['list'][$index]['ticket_name'] = $item->ticket->name;
               $incomes['list'][$index]['income'] = $this->CalculateIncomeBySaleType($item['sale_type'], $item['total'], $item['ticket_id'], $item['amount']);
               $incomes['list'][$index]['user'] = User::find($item['user_id']);
               $incomes['list'][$index]['date_formated'] = Carbon::parse($item->created_at)->format('d/m/Y');
               $total += $item['total'];
           }
           $incomes['total'] = $total;
           $incomes['customer'] = $customer;
           return $incomes;
     }
}