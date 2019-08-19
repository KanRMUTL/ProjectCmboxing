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
    public $roles ;
    protected $range;
    protected $now;
    protected $start;
    protected $end;
    public $saleTypeUrl;

    public function __construct() {
        $this->tickets = Ticket::all();
        $this->zones = Zone::all();
        $this->roles = ['แอดมิน','หัวหน้าฝ่ายการตลาด', 'พนักงานฝ่ายการตลาด'];
        $this->now = Carbon::now();
        $this->start =  $this->now->startOfWeek()->format('Y-m-d');
        $this->end = $this->now->endOfWeek()->format('Y-m-d');
        $this->saleTypes = ['ปกติ', 'ขายผ่านไกด์', 'หน้า Office', 'Walk in'];
        $this->range = ['start' => $this->start, 'end' => $this->end];
        $this->saleTypeUrl = [
            'employee' => 0,
            'guide' => 1,
            'office' => 2,
            'walkin' => 3
        ];
    }

    public function changeRedirect($saleTypeId)
    {
        if($saleTypeId == 0) return '/sale/employee';
        else if($saleTypeId == 1) return 'sale/guide';
        else if($saleTypeId == 2) return 'sale/office';
        else return 'sale/walkin';
    }

    public function setDataForSaleType($saleTypeName)
    {
        if($saleTypeName == 'employee'){
            return [
                'url' => '/sale/employee',
                'header' => 'ข้อมูลการขายบัตรของพนักงาน',
                'saleTypeId' => 0
            ];
        } else if($saleTypeName == 'guide') {
            return [
                'url' => '/sale/guide',
                'header' => 'ข้อมูลการขายบัตรของไกด์',
                'saleTypeId' => 1
            ];
        } else if($saleTypeName == 'office') {
            return [
                'url' => '/sale/office',
                'header' => 'ข้อมูลการขายหน้า Office',
                'saleTypeId' => 2
            ];
        } else if($saleTypeName == 'walkin') {
            return [
                'url' => '/sale/walkin',
                'header' => 'ข้อมูลการขายบัตร Walk in',
                'saleTypeId' => 3
            ];
        }
    }
}
