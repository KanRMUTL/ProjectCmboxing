<?php

namespace App\Http\Controllers\shopping;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\shopping\Fight;
use App\MyClass\pos\ImageClass;
use Exception;

class FightController extends Controller
{
     public function index()
     {
          $data['fights'] = Fight::orderBy('day', 'desc')->get();
          return view('shopping.addmin.fight.index', $data);
     }

     public function store(Request $request)
     {
          try {
               $objImage = new ImageClass('fight', $request->file('img'));
               $objImage->uploadImage();

               $fight = new Fight();
               $fight->img = $objImage->imageName;
               $fight->day = $request->day;
               $fight->user_id = 1;
               $fight->save();
          } catch (Exception $ex) {
               return response()->json($ex);
          }
          return redirect('/fight');
     }

     public function edit(Fight $fight)
     {
          return view('shopping.addmin.fight.edit', $fight);
     }

     public function update(Request $request, $id)
     {
          $fight = Fight::find($id);
          if ($request->hasFile('img')) {
               $objImage = new ImageClass('fight', $request->file('img'));
               $objImage->originalName = $fight->img;
               $objImage->updateImage();
               $fight->img = $objImage->imageName;
               $fight->day = $request->day;
               $fight->save();
          } else {
               $fight->day = $request->day;
               $fight->save();
          }
          return redirect('/fight');
     }

     public function show($id)
     {
          $data = Fight::find($id);
          return response()->json($data);
     }

     public function destroy($id)
     {
          $imagePath =  'shopping/img/fight/';
          $trainer = Fight::find($id);
          unlink(public_path($imagePath . $trainer->img));
          $trainer->delete();
          return redirect('/fight');
     }
}
