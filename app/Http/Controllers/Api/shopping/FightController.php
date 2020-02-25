<?php

namespace App\Http\Controllers\Api\shopping;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\shopping\Fight;


class FightController extends Controller
{
    public function index()
    {
        $data = Fight::paginate(15);
        return response()->json($data);
    }
}
