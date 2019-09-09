<?php

namespace App\Http\Controllers\Api\marketing;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\marketing\Zone;

class ZoneController extends Controller
{
    public function index()
    {
        $data = Zone::all();
        return response()->json($data);
    }

    public function store(Request $request)
    {
        $zone = new Zone();
        $zone->name = $request->name;
        $zone->latitude = $request->latitude;
        $zone->longitude = $request->longitude;
        $zone->save();
        return response()->json($zone);
    }

    public function show(Zone $zone)
    {
        return response()->json($zone); 
    }

    public function update(Request $request, Zone $zone)
    {
        $zone->name = $request->name;
        $zone->save();
        return $zone;
    }

    public function destroy(Zone $zone)
    {
        $zone->delete();
    }

    public function guesthouse($id){
        $data = Zone::find($id);
        $data['guesthouses'] =  $data->guesthouses;
        return response()->json($data);
    }
}
