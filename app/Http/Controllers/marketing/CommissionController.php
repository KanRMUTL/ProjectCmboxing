<?php

namespace App\Http\Controllers\marketing;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\marketing\StarterController;
use App\MyClass\marketing\CommissionClass;
use App\marketing\Zone;
use Auth;

class CommissionController extends StarterController
{
    public function __construct()
    {
       parent::__construct();        
    }

    public function empCommission()
    {
        $userZone =  Auth::user()->employee->zone_id;
        $objCommission = new CommissionClass($this->start, $this->end, $userZone, 0);
        $data['commission'] = $objCommission->getCommissionOfEmp();
        $data['range'] = $this->range;
        $data['zones'] = $this->zones;
        $data['zoneSelected'] = $userZone;
        return view('marketing._commission.emp', $data);
    }

    public function searchEmp(Request $request)
    {   
        $data['range'] = ['start' => $request->start,'end' => $request->end];
        $objCommission = new CommissionClass($request->start, $request->end, $request->zoneId, 0);
        $data['commission'] = $objCommission->getCommissionOfEmp();
        $data['zones'] = $this->zones;
        $data['zoneSelected'] = $request->zoneId;
        return view('marketing._commission.emp', $data);
    }

    public function searchGuide(Request $request)
    {   
        $start = $request->start;
        $end = $request->end;
        $zoneId = $request->zoneId;
       
        $objCommission = new CommissionClass($start, $end, $zoneId, 1);
        $data['range'] = ['start' => $request->start, 'end' => $request->end];
        $data['commission'] = $objCommission->getCommissionOfGuide();
        $data['zoneSelected'] = $request->zoneId;
        $data['zones'] = $this->zones;
        return view('marketing._commission.guide', $data);
    }

    public function guideCommission()
    {
        $userZone =  Auth::user()->employee->zone_id;
        $objCommission = new CommissionClass($this->start, $this->end, $userZone, 1);
        $data['commission'] = $objCommission->getCommissionOfGuide();
        $data['range'] = $this->range;
        $data['zones'] = $this->zones;
        $data['zoneSelected'] = $userZone;
        return view('marketing._commission.guide', $data);
    }

}
