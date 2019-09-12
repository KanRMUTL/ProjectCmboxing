<?php

namespace App\Http\Controllers\marketing;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\marketing\Guesthouse;
use App\marketing\Zone;

class GuesthouseController extends Controller
{
    public function index()
    {
        $data = Guesthouse::all();
        return response()->json($data);
    }

    public function edit(Guesthouse $guesthouse)
    {
        $data['zones'] = Zone::all();
        $data['guesthouse'] = $guesthouse;
        return view('marketing.admin.menu.zone.guesthouse.edit', $data);
    }

    public function store(Request $request)
    {
        $guesthouse = new Guesthouse();
        $guesthouse->name = $request->name;
        $guesthouse->zone_id = $request->zone_id;
        $guesthouse->save();
        return back();
    }

    public function update(Request $request, Guesthouse $guesthouse)
    {
        $guesthouse->name = $request->name;
        $guesthouse->zone_id = $request->zone_id;
        $guesthouse->save();
        return redirect('/zone/'.$guesthouse->zone_id.'/guesthouse');
    }

    public function destroy(Guesthouse $guesthouse)
    {
        $guesthouse->delete();
        return back();
    }
}
