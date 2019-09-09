<?php

namespace App\Http\Controllers\Api\shopping;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\shopping\Fight;
use App\MyClass\pos\ImageClass;
use Exception;  

class FightController extends Controller
{
    public function index()
    {
        $data = Fight::paginate(15);
        return response()->json($data);
    }

    public function store(Request $request)
    {
        try {
            $objImage = new ImageClass('fight', $request->file('img'));
            $objImage->uploadImage();

            $fight = new Fight();
            $fight->img = $objImage->imageName;
            $fight->day = $request->day;
            // $fight->user_id = Auth::user()->id;
            $fight->user_id = 1;
            $fight->save();
        } catch (Exception $ex) {
            return response()->json($ex);
        }
    }

    public function update(Fight $fight)
    {
        // $fight = Fight::find($id);
        if ($fight->hasFile('img')) {
            $objImage = new ImageClass('fight', $request->file('img'));
            $objImage->originalName = $fight->img;
            $objImage->updateImage();
            $fight->img = $objImage->imageName;
            $fight->day = $request->day;
            $fight->save();
        } else {
            
            return response()->json($fight);
            $fight->day = $request->day;
            $fight->save();
         }
    }

    public function show($id)
    {
        $data = Fight::find($id);
        return response()->json($data);
    }

    public function destroy($id){
        $imagePath =  'shopping/img/fight/';
        $trainer = Fight::find($id);
        unlink(public_path($imagePath.$trainer->img));
        $trainer->delete();
    }
}
