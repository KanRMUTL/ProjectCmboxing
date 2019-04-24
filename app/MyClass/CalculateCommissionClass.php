<?php

namespace App\MyClass;

use App\marketing\GuideCommission;

class CalculateCommissionClass {

    public function calEmpCommission($ticketId, $amount)
    {
        $total = 0;
        
        if($amount <= 10){  // คิดค่าคอมมิชชั่นการขายบัตร 1-10 ใบ
            $total += $this->calFirst($ticketId, $amount);
        }
        else if($amount <= 20){  // คิดค่าคอมมิชชั่นการขายบัตร 1-20 ใบ
            $realAmount = $amount - 10;
            $total += $this->calSecond($ticketId, $realAmount);
            $total += $this->calFirst($ticketId, 10);
        }
        else if($amount <= 30){ // คิดค่าคอมมิชชั่นการขายบัตร 1-30 ใบ
            $realAmount = $amount - 20;
            $total += $this->calThird($ticketId, $realAmount);
            $total += $this->calSecond($ticketId, 10);
            $total += $this->calFirst($ticketId, 10);
        }
        else if($amount > 30){  // คิดค่าคอมมิชชั่นการขายบัตรมากกว่า 30 ใบ
            $realAmount = $amount - 30;
            $total += $this->calFour($ticketId, $realAmount);
            $total += $this->calThird($ticketId, 10);
            $total += $this->calSecond($ticketId, 10);
            $total += $this->calFirst($ticketId, 10);
        }
        return $total;
    }

    public function calFirst($ticketId, $amount)
    {
        if($ticketId == 1){
            return 20 * $amount;
        }
        else if($ticketId == 2){
            return 30 * $amount;
        }
        else if($ticketId == 3){
            return 50 * $amount;
        }
    }

    public function calSecond($ticketId, $amount)
    {
        if($ticketId == 1){
            return 30 * $amount;
        }
        else if($ticketId == 2){
            return 40 * $amount;
        }
        else if($ticketId == 3){
            return 70 * $amount;
        }
    }

    public function calThird($ticketId, $amount)
    {
        if($ticketId == 1){
            return 40 * $amount;
        }
        else if($ticketId == 2){
            return 60 * $amount;
        }
        else if($ticketId == 3){
            return 100 * $amount;
        }
    }
    
    public function calFour($ticketId, $amount)
    {
        if($ticketId == 1){
            return 50 * $amount;
        }
        else if($ticketId == 2){
            return 80 * $amount;
        }
        else if($ticketId == 3){
            return 130 * $amount;
        }
    }   

    public static function calGuideCommission($ticketId, $amount)
    {
       $commission = GuideCommission::where('ticket_id', '=', $ticketId)->get();
       return $commission[0]->commission * $amount;
    }
}