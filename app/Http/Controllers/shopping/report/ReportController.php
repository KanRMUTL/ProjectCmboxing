<?php

namespace App\Http\Controllers\shopping\report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\shopping\CourseRegister;
use App\shopping\SaleTicket;
use Mpdf\Mpdf;

class ReportController extends Controller
{
    public $ReportStyle = "
        <style>
            .body{ padding: 0; }
            .content, table,.bottom-left, .top-right{ font-family: 'Garuda'; font-size: 10pt; }
            .title { font-size: 12pt; width: 100%; padding: 3px; line-height: 1pt;}
            table { border-collapse: collapse; width: 100%; }
            table, tr, td, th { border: 1px solid #000; padding: 4px 6px; },
            .right { text-align: right; }
            .left { text-align: left; }
            .center { text-align: center; }
            th { color: #1a2cb2; background-color: #d9dae2; }
            .logo{ width: 8.5%; }
            .bottom-left {
                position: absolute;
                bottom: 8px;
                left: 16px;
                font-size: 18px;
            }
            .top-right {
                position: absolute;
                top: 8px;
                right: 16px;
                font-size: 16px;
                color: #7e838c;
            }
        </style>
        ";

    public function ReportTitle() {
        return "
            <img class='logo' src='".public_path()."/shopping/img/logo.png'>
            <p class='title'>ห้างหุ้นส่วนจำกัด ยิ่งเจริญ มวยไทย</p>
            <p class='title'>177  ถนนช้างเผือก  ตำบลศรีภูมิ  อำเภอเมืองเชียงใหม่  จังหวัดเชียงใหม่ 50200</p>
            <p class='title'>Tel: (053)216-489  Fax: (053)216-489</p>
        "; 
    }

    public function courseRegister(Request $request, $start, $end)
    {
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8']);
        $reports = CourseRegister::report($request->start, $request->end)->get();
        
        $html = "
        <div class='content center'>"
        .$this->ReportTitle().
        "<p class='title'>
            รายงานการขายคอร์สฝึกสอนมวยไทย
            วันที่ ".date('d/m/Y', strtotime($start))." 
            ถึงวันที่ ".date('d/m/Y', strtotime($end))." 
        </p>
                <table cellspacing='1'>
                    <tr>
                        <th>ชื่อคอร์ส</th>
                        <th>ชื่อลูกค้า</th>
                        <th>เบอร์โทรศัพท์</th>
                        <th>ชื่อครูฝึก</th>
                        <th>วันที่ลงทะเบียน</th>
                        <th>วันที่เริ่มเรียน</th>
                    </tr>
        ";

        foreach($reports as $report) {
            $userFullname = $report->user_firstname.'    '.$report->user_lastname;
            $html .= "
                <tr>
                    <td>".$report->course_name."</td>
                    <td>".$userFullname."</td>
                    <td class='center'>".$report->phone_number."</td>
                    <td class='center'>".$report->trainer_name."</td>
                    <td class='center'>".date('d/m/Y', strtotime($report->created_at))."</td>
                    <td class='center'>".date('d/m/Y', strtotime($report->start_course))."</td>
                </tr>
            ";
        }

        $html .= '</table></div>';
        $html = $this->ReportStyle.$html;
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }

    public function reportTicketOnline($start, $end)
    {
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8']);
       

        $data = SaleTicket::search($start, $end)->get();
        // return $data;
        $html = "
        <div class='content center'>"
        .$this->ReportTitle().
        "<p class='title'>
            รายงานการขายบัตรออนไลน์
            วันที่ ".date('d/m/Y', strtotime($start))." 
            ถึงวันที่ ".date('d/m/Y', strtotime($end))." 
        </p>
                <table >
                    <tr>
                        <th width='70'>รหัสการขาย</th>
                        <th>ชื่อลูกค้า</th>
                        <th class='right'>ยอดขาย</th>
                        <th>วันที่มาชมมวย</th>
                        <th>วันที่ซื้อ</th>
                    </tr>
        ";
        foreach($data as $item) {
            $html .= "
                <tr>
                    <td class='center'>".$item->id."</td>
                    <td>".$item->firstname."&emsp;". $item->lastname ."</td>
                    <td class='right'>".$item->total."</td>
                    <td class='center'>".date('d/m/Y', strtotime($item->visit))."</td>
                    <td class='center'>".date('d/m/Y', strtotime($item->created_at))."</td>
                </tr>
            ";
        }

        $html .= '</table></div>';
        $html = $this->ReportStyle.$html;
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }
}
