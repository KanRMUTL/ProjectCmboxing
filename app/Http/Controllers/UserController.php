<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\marketing\Zone;
use App\marketing\Role;
use Auth;

class UserController extends Controller
{
    //  public function __construct(){
    //      $this->middleware('admin');
    //  }

   

    public function index()
    {
        if(Auth()->user()->role_id == 1)
            $users = User::userForAdmin()->get();

        else
            $users = User::userForMkhead()->get();

        $data = [
            'users' => $users,
            'zones' => Zone::all(),
            'roles' => Role::all()
        ];
        return view('_user.index',$data);


    }

   
    public function create()
    {
       
    }

   
    public function store(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => $request->role,
            'zone_id' => $request->zone
        ]);

        return redirect('/user');
    }

  
    public function show($id)
    {
        
    }

  
    public function edit($id)
    {
       $user = User::find($id);
        $zones = Zone::get();
        $roles = Role::get();
        $data = [
            'user' => $user,
            'zones' => $zones,
            'roles' => $roles
        ];

        // return $data;
        return view('_user.edit',$data);
    }

   
    public function update(Request $request, $id)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => $request->role,
            'zone_id' => $request->zone,   
        ];

        if($request->password != null){
           $data['password'] = bcrypt($request->password);
         }
             User::find($request->id)->update($data);
         
         return redirect('user');

    }

  
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect('/user');
    }
}
