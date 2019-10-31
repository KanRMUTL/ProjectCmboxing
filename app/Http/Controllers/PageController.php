<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\marketing\Sale;
use App\marketing\Employee;
use Carbon\Carbon;
use Auth;

class PageController extends Controller
{
    
    public $now;
    public $startOfWeek;
    public $endOfWeek;

    public function __construct()
    {
        $this->now = Carbon::now();
        $this->startOfWeek =  $this->now->startOfWeek()->format('Y-m-d');
        $this->endOfWeek = $this->now->endOfWeek()->format('Y-m-d');
    }
    public function index()
    {
        $ticketAmount = Sale::amountTicket($this->startOfWeek, $this->endOfWeek)->get();
        $customerAmount = Sale::amountCustomer($this->startOfWeek, $this->endOfWeek)->get();
        $income = Sale::calIncome($this->startOfWeek, $this->endOfWeek)->get();
        $employee = Auth::user()->role != 1 ?  Employee::where('zone_id' ,'=', Auth::user()->employee->zone_id)->count() : Employee::count();
        $employee -= 1;
        $data = [
            'ticketAmount' =>  $ticketAmount[0]->amount == null ? 0 : $ticketAmount[0]->amount,
            'customerAmount' => $customerAmount[0]->amount,
            'income' =>  $income[0]->total,
            'employee' => $employee
        ];
            return view('marketing.admin.index',$data);
    }
}
