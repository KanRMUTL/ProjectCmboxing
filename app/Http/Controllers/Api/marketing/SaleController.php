<?php

namespace App\Http\Controllers\Api\marketing;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\marketing\StarterController;
use Illuminate\Support\Facades\DB;
use App\User;
use App\MyClass\marketing\CommissionClass;
use App\MyClass\marketing\IncomeProfileClass;
use App\MyClass\marketing\SalingProfile;

class SaleController extends StarterController
{
   
    public function show(Request $request, $user_id)
    {
        if($request->isMethod('post')){
            $objCommission = new CommissionClass($request->start, $request->end, null, 0, $user_id);
            $objIncome = new IncomeProfileClass($request->start, $request->end, $user_id);
            $objSaling = new SalingProfile($request->start, $request->end, $user_id);
        } else {
            $objCommission = new CommissionClass($this->start, $this->end, null, 0, $user_id);
            $objIncome = new IncomeProfileClass($this->start, $this->end, $user_id);
            $objSaling = new SalingProfile($this->start, $this->end, $user_id);
        }

        $data['user'] = User::find($user_id);
        $data['commission']['emp'] = $objCommission->getCommissionEmpProfile();
        $objCommission->saleTypeId = 1;
        $data['commission']['guide'] = $objCommission->getCommissionGuideProfile();
        $data['income'] = $objIncome->CalculateIncomeProfile();
        $data['saling'] = $objSaling->SaleProfile();
        $data['countTicket'] = $objSaling->countTicket();
        // dd($objSaling);
        return response()->json($data);
    }
   
}
