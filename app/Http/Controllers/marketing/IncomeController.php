<?php
// เรียกข้อมูลเหมือนหาค่าคอมมิชชั่นนั่นแหละแต่เอา total ลบ ค่าคอม ก็จะรู้รายได้ของสนาม
namespace App\Http\Controllers\marketing;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\marketing\SaleController;
use App\marketing\Sale;
use App\Http\Controllers\marketing\CommissionController;
use App\Http\Controllers\marketing\StarterController;

class IncomeController extends StarterController
{

    protected $commission = CommissionController::class;

    public function income()
    {
        $data = Sale::select(DB::raw('SUM(amount) AS amount'), 'ticket_id',DB::raw('SUM(total) AS total'), 'sale_type')
                    ->groupBy('user_id', 'ticket_id', 'sale_type', 'created_at')
                    ->get();

        foreach($data as $index => $item){
            $data[$index]['income'] = $this->calIncome($item['sale_type'], $item['total'], $item['ticket_id'], $item['amount']);
            $data[$index]['sale_type_name'] = $item->saleType->name;
            $data[$index]['ticket_name'] = $item->ticket->name;
            $data[$index]['commission'] = CommissionController::calEmpCommission($item->ticket_id, $item->amount);
        }
        return $data;
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
}
