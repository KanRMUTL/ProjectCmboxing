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

    public function create()
    {
        
    }

    public function store(Request $request)
    {
        // try{
        //     $image_filename = $request->file('img');      
        //     $image_name = date('Ymd-His-').$image_filename;       
        //     $public_path = 'shopping/img/trainer';
        //     $destination =  base_path() . '/public/'. $public_path;
        //     $file = $request->file('img')->move($destination, $image_name);
        //     $trainer = new Trainer();
        //     $trainer->name = $request->name;
        //     $trainer->detail = $request->detail;
        //     $trainer->img = $image_name;
        //     $trainer->save();
        // }
        // catch(Exception $ex){
        //     return response()->json($ex);
        // }
        // return response()->json($trainer);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

  
    public function destroy($id)
    {
        //
    }
}
