<?php

namespace App\Http\Controllers\Api\marketing;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\marketing\CommissionController;
use Illuminate\Support\Facades\DB;
use App\User;
use App\marketing\Sale;
use App\marketing\child\SaleProfile;


class SaleController extends CommissionController
{
    public function __construct()
    {
       parent::__construct();        
    }

    public function index()
    {
        //
    }
   
    public function create()
    {
        //
    }
   
    public function store(Request $request)
    {
        //
    }
   
    public function show($user_id)
    {
        //  แสดงโปรไฟล์การขายบัตรของพนักงาน
        
        $data['customer'] = SaleProfile::ticketSaling($user_id)->get();
        
        $data['commission']['emp'] = SaleProfile::CommissionProfile($user_id, $this->start, $this->end, 0)->get();
        $data['commission']['empTotal'] = 0;
        $data['commission']['guide'] = SaleProfile::CommissionProfile($user_id, $this->start, $this->end, 1)->get();
        $data['commission']['guideTotal'] = 0;
        $data['income']['data'] = SaleProfile::incomeProfile($user_id, $this->start, $this->end)->get();
        $data['income']['incomeTotal'] = 0;
        
        foreach($data['commission']['emp'] as $index => $item) {
            $data['commission']['emp'][$index]['total'] = $this->calEmpCommission($item->ticket_id, $item->amount);
            $data['commission']['empTotal'] += $this->calEmpCommission($item->ticket_id, $item->amount);
        }

        foreach($data['commission']['guide'] as $index => $item) {
            $data['commission']['guide'][$index]['total'] = $this->calGuideCommission($item->ticket_id, $item->amount);
            $data['commission']['guideTotal'] += $this->calGuideCommission($item->ticket_id, $item->amount);
        }

        foreach($data['income']['data'] as $index => $item) {
            $data['income']['data'][$index]['income'] = $item['sumTotal'] - $this->calEmpCommission($item['ticket_id'], $item['amount']);
            $data['income']['incomeTotal'] += $data['income']['data'][$index]['income'];
        }

        return response()->json($data);
    }
   
    public function edit($id)
    {
        //
    }
   
    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
