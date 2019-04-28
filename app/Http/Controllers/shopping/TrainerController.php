<?php

namespace App\Http\Controllers\shopping;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\shopping\Trainer;
use App\MyClass\pos\ImageClass;
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
            $objImage = new ImageClass('trainer', $request->file('img'));
            $objImage->uploadImage();

            $trainer = new Trainer();
            $trainer->name = $request->name;
            $trainer->detail = $request->detail;
            $trainer->img = $objImage->imageName;
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
                $objImage = new ImageClass('trainer', $request->file('img'));
                $objImage->originalName = $trainer->img;
                $objImage->updateImage();
                $trainer->update([
                    'name' => $request->name,
                    'detail' => $request->detail,
                    'img' => $objImage->imageName
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
        $imagePath =  'shopping\img\trainer\\';
        $trainer = Trainer::find($id);
        unlink(public_path($imagePath.$trainer->img));
        $trainer->delete();
        return redirect('/trainer');
    }
}
