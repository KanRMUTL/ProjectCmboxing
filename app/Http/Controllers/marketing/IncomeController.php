<?php
// เรียกข้อมูลเหมือนหาค่าคอมมิชชั่นนั่นแหละแต่เอา total ลบ ค่าคอม ก็จะรู้รายได้ของสนาม
namespace App\Http\Controllers\marketing;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\marketing\SaleController;
use App\User;
use Auth;
use App\marketing\Sale;
use Carbon\Carbon;
use App\Http\Controllers\marketing\CommissionController;
use App\Http\Controllers\marketing\StarterController;

class IncomeController extends StarterController
{

    // protected $commission = CommissionController::class;

    public function __construct(){
        parent::__construct();
    }

    public function income()
    {
        $incomes = Sale::Income(Auth::user()->employee->zone_id, $this->start, $this->end)->get();
        foreach($incomes as $index => $item){
            $incomes[$index]['sale_type_name'] = $this->saleTypes[$item['sale_type']];
            $incomes[$index]['ticket_name'] = $item->ticket->name;
            $incomes[$index]['commission'] = CommissionController::calEmpCommission($item->ticket_id, $item->amount);
            $incomes[$index]['income'] = $item['total'] - $item['commission'];
            $incomes[$index]['user'] = User::find($incomes[$index]['user_id']);
        }
        $data['incomes'] = $incomes;
        $data['zones'] =  $this->zones;
        $data['zoneSelected'] = Auth::user()->employee->zone_id;
        $data['range'] = $this->range;
        return view('marketing._income/index', $data);
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

    public function searchIncome(Request $request)
    {
        $incomes = Sale::Income($request->zoneId, $request->start, $request->end)->get();
        foreach($incomes as $index => $item){
            $incomes[$index]['sale_type_name'] = $this->saleTypes[$item['sale_type']];
            $incomes[$index]['ticket_name'] = $item->ticket->name;
            $incomes[$index]['commission'] = CommissionController::calEmpCommission($item->ticket_id, $item->amount);
            $incomes[$index]['income'] = $item['total'] - $item['commission'];
            $incomes[$index]['user'] = User::find($incomes[$index]['user_id']);
        }
        $data['incomes'] = $incomes;
        $data['zones'] =  $this->zones;
        $data['zoneSelected'] = $request->zoneId;
        $data['range'] = ['start' => $request->start, 'end' => $request->end];
        return view('marketing._income/index', $data);
    }
}
