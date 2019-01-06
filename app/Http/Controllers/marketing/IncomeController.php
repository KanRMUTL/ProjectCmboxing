<?php

namespace App\Http\Controllers\marketing;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\marketing\SaleController;
use App\marketing\Sale;

class IncomeController extends SaleController
{
    public function income()
    {
        return view();
    }
}
