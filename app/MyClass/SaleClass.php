<?php 

namespace App\MyClass;

use Auth;
use Carbon\Carbon;
use App\marketing\Sale as SaleModel;
use App\Http\Controllers\marketing\Guesthouse;

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
    
     public function SearchSale() {
          $sales = $this->SaleDetail(
               $this->start, 
               $this->end, 
               $this->zoneId, 
               $this->saleTypeId
          );
          return $sales;
     }

     public function SaleDetail($before, $after, $zoneId = null, $saleType = null)
     {
         if(Auth::user()->role == 1)
         {   
             // แอดมิน
             return SaleModel::
                 where(
                     [
                         ['zone_id', '=', $zoneId], 
                         ['sale_type', '=', $saleType]
                     ]
                 )
                 ->whereBetween('created_at', [$before, $after])
                 ->orderByRaw('created_at DESC')->get();
         }
         else if(Auth::user()->role == 2)
         {   
             // หัวหน้าฝ่ายการตลาด
             return SaleModel::
                 where(
                     [
                         ['zone_id', '=', $zoneId], 
                         ['sale_type', '=', $saleType]
                     ]
                 )
                 ->whereBetween('created_at', [$before, $after])
                 ->orderByRaw('created_at DESC')->get();
         }
         else if(Auth::user()->role == 3)
         {   
             // พนักงานการตลาด
             return SaleModel::
                 where(
                     [
                         ['zone_id', '=', $zoneId], 
                         ['sale_type', '=', $saleType],
                         ['user_id', '=', Auth::user()->id]
                     ]
                 )
                 ->whereBetween('created_at', [$before, $after])
                 ->orderByRaw('created_at DESC')->get();
         }
     }
}