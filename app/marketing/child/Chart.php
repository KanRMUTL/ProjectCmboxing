<?php

namespace App\marketing\child;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\marketing\Sale;
class Chart extends Sale
{
   
    public function __construct()
    {
        parent::__construct();
    }

    public function scopeChartWeek($query,$date)
    {
        return $query
            ->select('customer_name','total')
            ->whereBetween('created_at', [
                $this->now->startOfWeek()->format('Y-m-d'),
                $this->now->endOfWeek()->format('Y-m-d'),
            ]);
    }

    public function scopeChartZoneTotal($query, $before, $after)  // หารายได้ของแต่ละโซนรวมกันทั้งหมดเรียงจากมากไปน้อย
    {
       return $query
            ->select('zone_id',DB::raw('SUM(total) as total'))
            ->whereBetween('created_at',[$before, $after])
            ->groupBy('zone_id')
            ->orderBy(DB::raw('SUM(total)'),'ADSC');
    }

    public function scopeChartZoneCustomer($query, $before, $after)  // หารายได้ของแต่ละโซนรวมกันทั้งหมดเรียงจากมากไปน้อย
    {
        return $query
            ->select('zone_id',DB::raw('COUNT(id) as total'))
            ->whereBetween('created_at', [$before, $after])
            ->groupBy('zone_id')
            ->orderBy(DB::raw('COUNT(id)'),'ADSC');
    }

    public function scopeChartTicket($query, $before, $after)  // หารายได้ของแต่ละโซนรวมกันทั้งหมดเรียงจากมากไปน้อย
    {
        if($this->roleId == 1) 
        {
            return $query
                ->select('ticket_id',DB::raw('SUM(amount) as total'))
                ->whereBetween('created_at', [$before, $after])
                ->groupBy('ticket_id')
                ->orderBy(DB::raw('SUM(amount)'),'ADSC');
        }
        else if($this->roleId == 2)
        {
            return $query
                ->select('ticket_id', DB::raw('SUM(amount) as total'))
                ->where('zone_id', '=', Auth::user()->zone_id)
                ->whereBetween('created_at', [$before, $after])
                ->groupBy('ticket_id')
                ->orderBy(DB::raw('SUM(amount)'),'ADSC');
        }
    }

    public function scopeChartAmountCustomer($query, $before, $after)
    {
        return $query
            ->select('user_id',DB::raw('COUNT(id) as customer_amount'))
            ->where('zone_id', '=', Auth::user()->zone_id)
            ->whereBetween('created_at', [$before, $after])
            ->groupBy('user_id')
            ->orderBy(DB::raw('COUNT(id)'),'ADSC');
    }
}
