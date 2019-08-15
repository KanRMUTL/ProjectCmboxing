<?php

namespace App\Http\Controllers;

use App\shopping\WebDetail;

class LineNotify extends Controller
{
     public $sale;
     public $messageFormated;
     public $saleTypes = ['ปกติ', 'ขายผ่านไกด์', 'หน้า Office'];
     

     public function formatMessage() {
          $saleType = $this->saleTypes[$this->sale['sale_type']];
         $this->messageFormated = 
               $this->sale->user->firstname." ".$this->sale->user->lastname
               ."โซน ". $this->sale->zone->name
               ."\nขายบัตรประเภท ". $saleType ."  จำนวน ".$this->sale['amount'] ." ใบ\n"
               ."ยอดขายรวมทั้งหมด ".number_format($this->sale['total']) ." บาท"
               ;
     }

     public function notify($sale)
     {
          $this->sale = $sale;
          $this->formatMessage();
         $line_api = 'https://notify-api.line.me/api/notify';
         $line_token = WebDetail::first()->line_token;;
 
         $queryData = array('message' => $this->messageFormated);
         $queryData = http_build_query($queryData,'','&');
         $headerOptions = array(
             'http'=>array(
                 'method'=>'POST',
                 'header'=> "Content-Type: application/x-www-form-urlencoded\r\n"
                     ."Authorization: Bearer ".$line_token."\r\n"
                     ."Content-Length: ".strlen($queryData)."\r\n",
                 'content' => $queryData
             )
         );
         $context = stream_context_create($headerOptions);
         $result = file_get_contents($line_api, FALSE, $context);
         $res = json_decode($result);
         return $res;
     }
}
