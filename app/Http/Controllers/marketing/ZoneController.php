<?php

namespace App\Http\Controllers\marketing;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\marketing\Zone;

class ZoneController extends Controller
{
    public function index()
    {
        $data['zones'] = Zone::all();
        return view('marketing.admin.menu.zone.index', $data);
    }

    public function store(Request $request)
    {
        $zone = new Zone();
        $zone->name = $request->name;
        $zone->latitude = $request->latitude;
        $zone->longitude = $request->longitude;
        $zone->save();
        return redirect('/zone');
    }

    public function show(Zone $zone)
    {
        return response()->json($zone); 
    }

    public function edit(Zone $zone)
    {
        return view('marketing.admin.menu.zone.edit', $zone);
    }

    public function update(Request $request, Zone $zone)
    {
        $zone->name = $request->name;
        $zone->save();
        return redirect('/zone');
    }

    public function destroy(Zone $zone)
    {
        $zone->delete();
        return redirect('/zone');
    }

    public function guesthouse($id){
        $data['zone'] = Zone::find($id);
        $data['guesthouses'] =  $data['zone']->guesthouses;
        return view('marketing.admin.menu.zone.guesthouse.index', $data);
    }
}
