<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Webdetail;
use Exception;

class WebdetailController extends Controller
{
    public function index()
    {
        $data = Webdetail::find(1);
        return view('webdetail', $data);
    }

    public function update(Request $request)
    {
	$webdetail = Webdetail::find(1);
        try{
            $webdetail->email = $request->email;   
            $webdetail->phone = $request->phone;   
            $webdetail->about = $request->about;   
            $webdetail->facebook = $request->facebook;   
            $webdetail->line_token = $request->line_token;   
            $webdetail->save();
            return $this->index();
        }
        catch(Exception $e){
            return response()->json($e);
        }
    }
}
