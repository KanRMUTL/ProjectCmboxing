<?php

namespace App\Http\Controllers\marketing\report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Users;
use Auth;
use App\marketing\Sale;
use App\marketing\Zone;
use App\marketing\Ticket;
use App\marketing\Guesthouse;
use App\marketing\SaleType;
use App\marketing\GuideCommission;
use Carbon\Carbon;
use App\Http\Controllers\marketing\StarterController;
use App\Http\Controllers\marketing\CommissionController;
use Mpdf\Mpdf;

class ReportController extends StarterController
{
    
    public function saleReport(Request $request)
    {
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-L']);
        $saleTypeId = $this->saleTypeUrl[$request->saleTypeName];
        $sales = Sale::saleDetail($request->start, $request->end, $request->zoneId, $saleTypeId)->get();
        $html = "
        <style>
            .content, table{
                font-family: 'Garuda';
                font-size: 10pt;
            }
            .title{
                font-size: 15pt;
                width: 100%;
            }
            table{
                border-collapse: collapse;
                width: 100%;
            }
            table, tr, td, th{
                border: 1px solid #000;
                padding: 4px 6px;
            },
            .right {
                text-align: right;
            }
            .left {
                text-align: left;
            }
            .center {
                text-align: center;
            }
        </style>
        <div class='content center'>
        <p class='title'>
            รายงานการขาย
            วันที่ ".date('d/m/Y', strtotime($request->start))." 
            ถึงวันที่ ".date('d/m/Y', strtotime($request->end))." 
        </p>
                <table cellspacing='1'>
                    <tr>
                    <th>ชื่อลูกค้า</th>
                    <th>เบอร์โทร</th>
                    <th>หมายเลขห้อง</th>
                    <th>เกสเฮาท์</th>
                    <th>บัตร</th>
                    <th>จำนวน</th>
                    <th>ยอดรวม</th>
                    <th>วันที่เข้ามาชมมวย</th>
                    <th>ผู้ขาย</th>
                    <th>วันที่ขาย</th>
                    </tr>
        ";
        foreach($sales as $sale) {
            $html .= "
                <tr>
                    <td>".$sale->customer_name."</td>
                    <td>".$sale->customer_phone."</td>
                    <td class='center'>".$sale->customer_room."</td>
                    <td class='center'>".$sale->guesthouse->name."</td>
                    <td class='center'>".$sale->ticket->name."</td>
                    <td class='center'>".$sale->amount."</td>
                    <td class='right'>".number_format($sale->total, 2, '.',',')."</td>
                    <td class='center'>".$sale->visit."</td>
                    <td>".$sale->user->firstname."&emsp;".$sale->user->lastname."</td>
                    <td class='center'>".date('d/m/Y', strtotime($sale->created_at))."</td>
                </tr>
            ";
        }

        $html .= '</table></div>';
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }

    public function EmpCommissionReport(Request $request)
    {
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8',]);
        $objCommission = new CommissionController();
        $commissions = $objCommission->getCommissionOfEmp($request->start,$request->end, $request->zoneId);
        $html = "
            <style>
                .content, table{
                    font-family: 'Garuda';
                    font-size: 10pt;
                }
                .title{
                    font-size: 15pt;
                }
                table{
                    border-collapse: collapse;
                    width: 100%;
                }
                table, tr, td, th{
                    border: 1px solid #000;
                    padding: 4px 6px;
                },
                .right {
                    text-align: right;
                }
                .left {
                    text-align: left;
                }
                .center {
                    text-align: center;
                }
            </style>
            <div class='content center'>
            <p class='title'>
                รายงานค่าคอมมิชชั่นพนักงาน
                วันที่ ".date('d/m/Y', strtotime($request->start))." 
                ถึงวันที่ ".date('d/m/Y', strtotime($request->end))." 
            </p>
                    <table cellspacing='1'>
                        <tr>
                            <th>ชื่อพนักงาน</th>
                            <th>โซน</th>
                            <th>ประเภทบัตร</th>
                            <th>จำนวนที่ขาย</th>
                            <th>ค่าคอมมิชชั่น</th>
                            <th>วันที่</th>
                        </tr>
        ";
        foreach($commissions as $commission)
        {
            $html .= "
                <tr>
                    <td>".$commission->user->firstname."&emsp;".$commission->user->lastname."</td>
                    <td class='center'>".$commission->user->employee->zone->name."</td>
                    <td class='center'>".$commission->ticket->name."</td>
                    <td class='center'>". $commission->amount."</td>
                    <td class='right'>".number_format($commission->commission, 2, '.',',') ."</td>
                    <td class='center'>".$commission->date_formated."</td>
                </tr>
            ";
        }

        $html .= '</table></div>';
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }

    public function guideCommissionReport(Request $request)
    {
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8',]);
        $objCommission = new CommissionController();
        $commissions = $objCommission->getCommissionOfGuide($request->start, $request->end, $request->zoneId);
        $html = "
            <style>
                .content, table{
                    font-family: 'Garuda';
                    font-size: 10pt;
                }
                .title{
                    font-size: 15pt;
                }
                table{
                    border-collapse: collapse;
                    width: 100%;
                }
                table, tr, td, th{
                    border: 1px solid #000;
                    padding: 4px 6px;
                },
                .right {
                    text-align: right;
                }
                .left {
                    text-align: left;
                }
                .center {
                    text-align: center;
                }
            </style>
            <div class='content center'>
            <p class='title'>
                รายงานค่าคอมมิชชั่นไกด์
                วันที่ ".date('d/m/Y', strtotime($request->start))." 
                ถึงวันที่ ".date('d/m/Y', strtotime($request->end))." 
            </p>
                    <table cellspacing='1'>
                        <tr>
                            <th>ชื่อพนักงาน</th>
                            <th>โซน</th>
                            <th>ประเภทบัตร</th>
                            <th>จำนวนที่ขาย</th>
                            <th>ค่าคอมมิชชั่น</th>
                            <th>วันที่</th>
                        </tr>
        ";
        
        foreach($commissions as $commission)
        {
            $html .= "
                <tr>
                    <td>".$commission->user->firstname."&emsp;". $commission->user->lastname ."</td>
                    <td class='center'>".$commission->user->employee->zone->name."</td>
                    <td class='center'>".$commission->ticket->name."</td>
                    <td class='center'>".$commission->amount."</td>
                    <td class='right'>".number_format($commission->commission, 2, '.',',')."</td>
                    <td class='center'>". $commission->date_formated ."</td>
                </tr>
            ";
        }

        $html .= '</table></div>';
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }
}