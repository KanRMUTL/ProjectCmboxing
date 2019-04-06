<?php

namespace App\Http\Controllers\shopping;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\shopping\Trainer;
class TrainerController extends Controller
{
    
    public function index()
    {
        $data['trainers'] = Trainer::all();
        return view('shopping.addmin.trainer.index', $data);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        try{
            $image_filename = $request->file('img')->getClientOriginalName();      
            $image_name = date('Ymd-His-').$image_filename;       
            $public_path = 'shopping/img/trainer';
            $destination =  base_path() . '/public/'. $public_path;
            $file = $request->file('img')->move($destination, $image_name);

            $trainer = new Trainer();
            $trainer->name = $request->name;
            $trainer->detail = $request->detail;
            $trainer->img = $image_name;
            $trainer->save();
        }
        catch(Exception $ex){
            return response()->json($ex);
        }
        return redirect('/trainer');
    }

    public function show($id)
    {
        
    }

    public function edit($id)
    {
        $data['trainer'] = Trainer::find($id);
        return view('shopping.addmin.trainer.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $trainer = Trainer::find($id);
        if($request->hasFile('img')){ 
            $oldImagePath =  'shopping\img\trainer\\'.$trainer->img;
            unlink(public_path($oldImagePath));
            $image_filename = $request->file('img')->getClientOriginalName();       
            $image_name = date('Ymd-His-').$image_filename;       
            $public_path = 'shopping/img/trainer';       
            $destination = base_path() . "/public/" . $public_path;      
            $request->file('img')->move($destination, $image_name); 
            $trainer->update([
                'name' => $request->name,
                'detail' => $request->detail,
                'img' => $image_name
            ]);
        }
        else 
        {
            $trainer->update(
                [
                    'name' => $request->name,
                    'price' => $request->price
                ]
            );
        } 
        return redirect('/trainer');
    }

  
    public function destroy($id)
    {
        $trainer = Trainer::find($id);
        $trainer->delete();
        return redirect('/trainer');
    }
}
