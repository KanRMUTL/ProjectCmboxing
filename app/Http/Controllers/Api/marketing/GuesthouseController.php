<?php

namespace App\Http\Controllers\Api\marketing;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\marketing\Guesthouse;

class GuesthouseController extends Controller
{
    public function index()
    {
        $data = Guesthouse::all();
        return response()->json($data);
    }

    public function store(Request $request)
    {
        $guesthouse = new Guesthouse();
        $guesthouse->name = $request->name;
        $guesthouse->zone_id = $request->zone_id;
        $guesthouse->save();
        return response()->json($guesthouse);
    }

    public function show(Guesthouse $guesthouse) {
        return response()->json($guesthouse);
    }

    public function update(Request $request, Guesthouse $guesthouse)
    {
        $guesthouse->name = $request->name;
        $guesthouse->zone_id = $request->zone_id;
        $guesthouse->save();
        return response()->json($guesthouse);
    }

    public function destroy(Guesthouse $guesthouse)
    {
        $guesthouse->delete();
    }
}
