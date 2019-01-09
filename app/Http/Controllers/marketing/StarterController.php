<?php

namespace App\Http\Controllers\marketing;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Users;
use Auth;
use App\marketing\Sale;
use App\marketing\Zone;
use App\marketing\Ticket;
use App\marketing\Guesthouse;
use App\marketing\SaleType;
use Carbon\Carbon;
class StarterController extends Controller
{
    protected $tickets;
    protected $zones;
    protected $saleTypes;
    protected $range;
    protected $now;
    protected $start;
    protected $end;
    protected $saleTypeUrl;

    public function __construct(){
        $this->tickets = Ticket::all();
        $this->zones = Zone::all();
        $this->saleTypes = SaleType::all();
        $this->now = Carbon::now();
        $this->start =  $this->now->startOfWeek()->format('Y-m-d');
        $this->end = $this->now->endOfWeek()->format('Y-m-d');
        $this->range = [
            'start' => $this->start,
            'end' => $this->end
        ];
        $this->saleTypeUrl = [
            'employee' => 1,
            'guide' => 2,
            'office' => 3
        ];
    }

    public function changeRedirect($saleTypeId)
    {
        if($saleTypeId == 1)
             return '/sale/employee';
        else if($saleTypeId == 2)
            return 'sale/guide';
        else
            return 'sale/office';
    }

    public function setDataForSaleType($saleTypeName)
    {
        $data = [];
        if($saleTypeName == 'employee'){
            $data = [
                'url' => '/sale/employee',
                'header' => 'ข้อมูลการขายบัตรของพนักงาน',
                'saleTypeId' => 1
            ];
        } else if($saleTypeName == 'guide') {
            $data = [
                'url' => '/sale/guide',
                'header' => 'ข้อมูลการขายบัตรของไกด์',
                'saleTypeId' => 2
            ];
        } else if($saleTypeName == 'office') {
            $data = [
                'url' => '/sale/office',
                'header' => 'ข้อมูลการขายหน้า Office',
                'saleTypeId' => 3
            ];
        }
        return $data;
    }
}