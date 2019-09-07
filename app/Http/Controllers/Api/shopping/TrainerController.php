<?php

namespace App\Http\Controllers\Api\shopping;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\shopping\Trainer;


class TrainerController extends Controller
{
    
    public function index()
    {
        $trainer = Trainer::all();
        return response()->json($trainer);
    }
}
