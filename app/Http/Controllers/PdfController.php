<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mpdf\Mpdf;
use Illuminate\Support\Facades\DB;
use App\marketing\Sale;
class PdfController extends Controller
{
    public function index()
    {
        $sale =  Sale::select('created_at', 'guesthouse_id', 'ticket_id', DB::raw('sum(amount) as amountcustomer'))
            ->groupBy('created_at', 'guesthouse_id', 'ticket_id')
            ->get();
        
        foreach($sale as $key => $val){
            $val->total = $val->ticket->price * $val->amountcustomer;
        }
       return $sale;
        // $mpdf = new \Mpdf\Mpdf();
        
        // $mpdf->WriteHTML($value);
        // $mpdf->Output();
    }
}
