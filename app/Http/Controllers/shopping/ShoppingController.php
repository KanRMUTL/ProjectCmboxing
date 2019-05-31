<?php

namespace App\Http\Controllers\shopping;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\shopping\Seat;
use App\marketing\Ticket;
use App\shopping\WebDetail;
use App\Http\Controllers\marketing\StarterController;
use App\MyClass\pos\ImageClass;
use App\Http\Requests\shopping\UserRegisterRequest;
use App\User;

class ShoppingController extends StarterController
{
    function index()
    {
        $data = [
            'tickets' => $this->tickets,
            'webdetail' => WebDetail::find(1)
        ];
        return view('shopping/index', $data);
    }

    function about()
    {
        $data = [
            'webdetail' => WebDetail::find(1)
        ];
        
        return view('shopping/about', $data);
    }

    public function saleTicket($id) {
        return view('shopping/sale_ticket', ['id' => $id]);
    }

    public function register(UserRegisterRequest $request) {
        $user = new User;

        if($request->hasfile('img')){
            $objImage = new ImageClass('user', $request->file('img'));
            $objImage->originalName = $user->img;
            $objImage->uploadImage();
            $user->img = $objImage->imageName;
        }

        $user->username = $request->username;
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        $user->address = $request->address;
        $user->role = 4;
        $user->password = bcrypt($request->password);
        $user->save();
        
        return redirect('/login');
    }
}
