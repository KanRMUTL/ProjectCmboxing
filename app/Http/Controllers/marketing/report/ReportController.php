<?php

namespace App\Http\Controllers\marketing\report;

use Auth;
use App\Users;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\MyClass\marketing\SaleClass;
use App\MyClass\marketing\CommissionClass;
use Carbon\Carbon;
use App\Http\Controllers\marketing\StarterController;
use Mpdf\Mpdf;

class ReportController extends StarterController
{
    public $ReportStyle = "
    <style>
        .body{ padding: 0; }
        .content, table { font-family: 'Garuda'; font-size: 10pt; }
        .title { font-size: 12pt; width: 100%; padding: 3px; line-height: 1pt;}
        table { border-collapse: collapse; width: 100%; }
        table, tr, td, th { border: 1px solid #000; padding: 4px 6px; },
        .right { text-align: right; }
        .left { text-align: left; }
        .center { text-align: center; }
        .th { width: 15%; font-size: 15pt; }
        .logo{ width: 8.5%; }
    </style>
    ";

    public function ReportTitle() {
        return "
        <img class='logo' src='".public_path()."/shopping/img/logo.png'>
        <p class='title'>ห้างหุ้นส่วนจำกัด ยิ่งเจริญ มวยไทย</p>
        <p class='title'>177  ถนนช้างเผือก  ตำบลศรีภูมิ  อำเภอเมืองเชียงใหม่  จังหวัดเชียงใหม่ 50200.</p>
        <p class='title'>Tel: (053)216-489  Fax: (053)216-489</p>
    "; 
    }

    public function saleReport(Request $request)
    {
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-L']);
        $saleTypeId = $this->saleTypeUrl[$request->saleTypeName];
        $objSale = new SaleClass($request->start, $request->end, $request->zoneId, $saleTypeId);
        $sales = $objSale->SearchSale();
        $html = "
        <div class='content center'>"
        .$this->ReportTitle().
        "<p class='title'>
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
        $html = $this->ReportStyle.$html;
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }

    public function EmpCommissionReport(Request $request)
    {
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8']);
        $objCommission = new CommissionClass($request->start,$request->end, $request->zoneId, 0, Auth::user()->id);
        $commissions = $objCommission->getCommissionOfEmp();
        $html = "
            <style> th { width: 20%; font-size: 135%; padding: 1.5%;} td { font-size: 125%; } </style>
            <div class='content center'>"
            .$this->ReportTitle().
            "
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
        $html = $this->ReportStyle.$html;
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }

    public function guideCommissionReport(Request $request)
    {
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8',]);
        $objCommission = new CommissionClass($request->start, $request->end, $request->zoneId, 1, Auth::user()->id);
        $commissions = $objCommission->getCommissionOfGuide();
        $html = "
        <style> th { width: 20%; font-size: 135%; padding: 1.5%;} td { font-size: 125%; }</style>
        <div class='content center'>"
        .$this->ReportTitle().
        "<p class='title'>
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
        $html = $this->ReportStyle.$html;
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }
}