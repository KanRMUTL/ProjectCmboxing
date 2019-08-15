<?php

namespace App\MyClass\marketing;

use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\marketing\Sale;
use App\MyClass\marketing\SaleClass;

class SalingProfile extends SaleClass {

     public $userId;
     
     public function __construct($start, $end, $userId) {
          $this->start = $start;
          $this->end = $end;
          $this->userId = $userId;
     }

     public function SaleProfile() {
          return Sale::
                  select(
                      'sales.id as id',
                      'users.id as userId',
                      'users.firstname as firstname',
                      'users.lastname as lastname',
                      'customer_name',
                      'customer_phone',
                      'customer_room',
                      'guesthouse_id',
                      'tickets.name as ticket_name',
                      'amount',
                      'visit',
                      'created_at',
                      'total'
                  )
                  ->join('users', 'sales.user_id', '=', 'users.id')
                  ->join('tickets', 'sales.ticket_id', '=', 'tickets.id')
                  ->where(
                      [
                          ['user_id', '=', $this->userId]
                      ]
                  )
                  ->whereBetween(DB::raw('DATE(created_at)'), [DB::raw(DATE($this->start)), DB::raw(DATE($this->end))])
                  ->orderByRaw('created_at DESC')
                  ->get();
     }

     public function countTicket() {
         return Sale:: select(DB::raw('SUM(amount) as total'))
         ->where([['user_id', '=', $this->userId]])
         ->whereBetween(DB::raw('DATE(created_at)'), [DB::raw(DATE($this->start)), DB::raw(DATE($this->end))])
         ->get();
     }
}