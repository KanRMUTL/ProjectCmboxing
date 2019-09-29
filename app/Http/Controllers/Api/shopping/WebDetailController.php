<?php

namespace App\Http\Controllers\Api\Shopping;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Shopping\WebDetail;

class WebDetailController extends Controller
{
     public function index() {
          $webdetail = WebDetail::first();
          return response()->json($webdetail);
     }
}