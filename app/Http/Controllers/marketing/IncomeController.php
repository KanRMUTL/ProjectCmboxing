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
use App\Http\Controllers\marketing\StarterController;
use App\MyClass\CommissionClass;
use App\MyClass\marketing\IncomeClass;

class IncomeController extends StarterController
{

    public function __construct() {
        parent::__construct();
    }

    public function income()
    {
        $objIncome = new IncomeClass($this->start, $this->end, Auth::user()->employee->zone_id);
        // dd($objIncome);
        $data['incomes'] = $objIncome->CalculateIncome();

        $data['zones'] =  $this->zones;
        $data['zoneSelected'] = Auth::user()->employee->zone_id;
        $data['range'] = $this->range;
        return view('marketing._income/index', $data);
    }

    public function searchIncome(Request $request)
    {
        $objIncome = new IncomeClass( $request->start, $request->end, $request->zoneId);
        $data['incomes'] = $objIncome->CalculateIncome();
        $data['zones'] =  $this->zones;
        $data['zoneSelected'] = $request->zoneId;
        $data['range'] = ['start' => $request->start, 'end' => $request->end];
        return view('marketing._income/index', $data);
    }
}
