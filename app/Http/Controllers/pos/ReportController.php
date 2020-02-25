<?php

namespace App\Http\Controllers\pos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\pos\Bill;
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
          <img class='logo' src='".public_path()."/shopping/img/Logo.png'>
          <p class='title'>ห้างหุ้นส่วนจำกัด ยิ่งเจริญ มวยไทย</p>
          <p class='title'>177  ถนนช้างเผือก  ตำบลศรีภูมิ  อำเภอเมืองเชียงใหม่  จังหวัดเชียงใหม่ 50200</p>
          <p class='title'>Tel: (053)216-489  Fax: (053)216-489</p>
     "; 
     }

     public function bill($id){
          $bills = Bill::find($id);
          $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8']);
          $sumTotal = 0;
          $html = "
          <div class='content center'>"
          .$this->ReportTitle().
          "<p class='title'>
              รหัสการขายสินค้า: ". $id ." วันที่: ".date('d/m/Y', strtotime($bills->created_at))." 
          </p>
                  <table cellspacing='1'>
                      <tr>
                          <th>ลำดับ</th>
                          <th>รายการ</th>
                          <th>จำนวน</th>
                          <th>ราคาต่อหน่วย</th>
                          <th>จำนวนเงิน</th>
                      </tr>
          ";
  
          foreach($bills->saleDetail as $key=>$bill) {
              $html .= "
                  <tr>
                      <td class='center'>".($key + 1)."</td>
                      <td>".$bill->product->name."</td>
                      <td class='right'>".number_format($bill->product->price)."</td>
                      <td class='center'>".$bill->amount."</td>
                      <td class='right'>".number_format($bill->product->price * $bill->amount)."</td>
                  </tr>
              ";
               $sumTotal += $bill->product->price * $bill->amount;
          }
          $html .= "
               <tr>
                    <td colspan='4' class='center'><b>รวม</b></td>
                    <td class='right'><b>".number_format($sumTotal)."</b></td>
               </tr>
          ";
  
          $html .= '</table></div>';
          $html = $this->ReportStyle.$html;
          $mpdf->WriteHTML($html);
          $mpdf->Output();
     }

     public function allBills($start, $end){
          $bills = Bill::whereBetween('created_at', [$start, $end])->get();
          $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8']);
          $html = "
          <div class='content center'>"
          .$this->ReportTitle().
          "<p class='title'>
               รายงานการขายสินค้า
               วันที่ ".date('d/m/Y', strtotime($start))." 
               ถึงวันที่ ".date('d/m/Y', strtotime($end))." 
          </p>
                  <table cellspacing='1'>
                      <tr>
                          <th>รัหสการขาย</th>
                          <th>ยอดรวม</th>
                          <th>เวลาที่ขาย</th>
                          <th>ผู้ขาย</th>
                      </tr>
          ";
  
          foreach($bills as $key=>$bill) {
               $fullname = $bill->user->firstname ."&emsp;".$bill->user->lastname;
              $html .= "
                  <tr>
                      <td class='center'>".$bill->id."</td>
                      <td class='right'>".$bill->total."</td>
                      <td class='center'>".date('d/m/Y', strtotime($bill->created_at))."</td>
                      <td class='center'>".$fullname."</td>
                  </tr>
              ";
          }
          $html .= '</table></div>';
          $html = $this->ReportStyle.$html;
          $mpdf->WriteHTML($html);
          $mpdf->Output();
     }


}