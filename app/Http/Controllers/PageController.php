<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\marketing\Sale;
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
        
        $ticketAmount = $this->amountTicket();
        $customerAmount = $this->amountCustomer();
        $income = $this->income();
        $data = [
            'ticketAmount' =>  $ticketAmount[0]->amount == null ? 0 : $ticketAmount[0]->amount,
            'customerAmount' => $customerAmount[0]->amount,
            'income' =>  $income[0]->total
        ];
        // if( Auth::user()->role== 1){
            return view('admin.index',$data);
        // }
        // else if( Auth::user()->role == 2){
        //     return view('head.index',$data);
        // }
        // else if( Auth::user()->role == 3){
        //     return view('employee.index',$data);
        // }
    }

    private function amountTicket()
    {
        if( Auth::user()->role == 1){
            return Sale::
                    select(DB::raw('SUM(amount) as amount'))
                    ->whereBetween('created_at', [$this->startOfWeek, $this->endOfWeek])
                    ->get();
        }
        else if(Auth::user()->role == 2){
            return Sale::
                    select(DB::raw('SUM(amount) as amount'))
                    ->where('zone_id', '=',  Auth::user()->employee->zone_id )
                    ->whereBetween('created_at', [$this->startOfWeek, $this->endOfWeek])
                    ->get();
        }
        else if( Auth::user()->role== 3){
            return Sale::
                    select(DB::raw('SUM(amount) as amount'))
                    ->where('user_id', '=', Auth::user()->id )
                    ->whereBetween('created_at', [$this->startOfWeek, $this->endOfWeek])
                    ->get();
        }
    }

    private function amountCustomer()
    {
        if( Auth::user()->role == 1){
            return Sale::
                select(DB::raw('COUNT(id) as amount'))
                ->whereBetween('created_at', [$this->startOfWeek, $this->endOfWeek])
                ->get();
        }
        else if(Auth::user()->role == 2){
            return Sale::
                select(DB::raw('COUNT(id) as amount'))
                ->where('zone_id', '=',  Auth::user()->employee->zone_id )
                ->whereBetween('created_at', [$this->startOfWeek, $this->endOfWeek])
                ->get();
        }
        else if( Auth::user()->role== 3){
            return Sale::
                select(DB::raw('COUNT(id) as amount'))
                ->where('user_id', '=', Auth::user()->id )
                ->whereBetween('created_at', [$this->startOfWeek, $this->endOfWeek])
                ->get();
        }
    }

    private function income()
    {
        if( Auth::user()->role == 1){
            return Sale::
                select(DB::raw('SUM(total) as total'))
                ->whereBetween('created_at', [$this->startOfWeek, $this->endOfWeek])
                ->get();
        }
        else if(Auth::user()->role == 2){
            return Sale::
                select(DB::raw('SUM(total) as total'))
                ->where('zone_id', '=',  Auth::user()->employee->zone_id )
                ->whereBetween('created_at', [$this->startOfWeek, $this->endOfWeek])
                ->get();
        }
        else if( Auth::user()->role== 3){
            return Sale::
                select(DB::raw('SUM(total) as total'))
                ->where('user_id', '=', Auth::user()->id )
                ->whereBetween('created_at', [$this->startOfWeek, $this->endOfWeek])
                ->get();
        }
    }
}
