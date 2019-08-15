<?php 

namespace App\MyClass\marketing;

use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\marketing\Sale as SaleModel;

class SaleClass {

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

     public function SearchSale()
     {
         if(Auth::user()->role == 1) { return $this->SaleForAdmin(); }
         else if(Auth::user()->role == 2) { return $this->SaleForHead(); }
         else if(Auth::user()->role == 3) { return $this->SaleForEmployee(); }
     }

     public function SaleForAdmin() {
        return SaleModel::
                select(
                    'sales.id as id',
                    'users.id as userId',
                    'users.firstname as firstname',
                    'users.lastname as lastname',
                    'customer_name',
                    'customer_phone',
                    'customer_room',
                    'guesthouse_id',
                    'ticket_id',
                    'amount',
                    'visit',
                    'created_at',
                    'total'
                )
                ->join('users', 'sales.user_id', '=', 'users.id')
                ->where(
                    [
                        ['zone_id', '=', $this->zoneId], 
                        ['sale_type', '=', $this->saleTypeId]
                    ]
                )
                ->whereBetween(DB::raw('DATE(created_at)'), [DB::raw(DATE($this->start)), DB::raw(DATE($this->end))])
                ->orderByRaw('created_at DESC')
                ->get();
     }

     public function SaleForHead() {
        return SaleModel::
                select(
                    'sales.id as id',
                    'users.id as userId',
                    'users.firstname as firstname',
                    'users.lastname as lastname',
                    'customer_name',
                    'customer_phone',
                    'customer_room',
                    'guesthouse_id',
                    'ticket_id',
                    'amount',
                    'visit',
                    'created_at',
                    'total'
                )
                ->join('users', 'sales.user_id', '=', 'users.id')
                ->where(
                    [
                        ['zone_id', '=', $this->zoneId], 
                        ['sale_type', '=', $this->saleTypeId]
                    ]
                )
                ->whereBetween(DB::raw('DATE(created_at)'), [DB::raw(DATE($this->start)), DB::raw(DATE($this->end))])
                ->orderByRaw('created_at DESC')
                ->get();
     }

     public function SaleForEmployee() {
        return SaleModel::
                select(
                    'sales.id as id',
                    'users.id as userId',
                    'users.firstname as firstname',
                    'users.lastname as lastname',
                    'customer_name',
                    'customer_phone',
                    'customer_room',
                    'guesthouse_id',
                    'ticket_id',
                    'amount',
                    'visit',
                    'created_at',
                    'total'
                )
                ->join('users', 'sales.user_id', '=', 'users.id')
                ->where(
                    [
                        ['sale_type', '=', $this->saleTypeId],
                        ['user_id', '=', Auth::user()->id]
                    ]
                )
                ->whereBetween(DB::raw('DATE(created_at)'), [DB::raw(DATE($this->start)), DB::raw(DATE($this->end))])
                ->orderByRaw('created_at DESC')
                ->get();
     }
}