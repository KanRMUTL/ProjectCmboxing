<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AddUser;
use App\User;
use App\marketing\Employee;
use App\marketing\Role;
use App\marketing\Zone;
use Auth;

class UserController extends Controller
{
    private $zones;
    private $roles;
    
    public function __construct()
    {
         $this->zones = Zone::all();
        //  $this->roles =  Auth::user()->role;
    }

    public function index()
    {
        if(Auth()->user()->role == 1)
            $users = User::userForAdmin()->paginate(10);
        else
            $users = User::userForMkhead()->paginate(10);
        
        $data = [
            'users' => $users,
            'zones' => $this->zones,
            'roles' => ['แอดมิน','หัวหน้าการตลาด', 'พนักงานการตลาด']
        ];
        return view('_user.index',$data);
    }
     
    public function store(Request $request)
    {
        $user = User::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'username' => $request->username,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);
        
        try{
            $employee = Employee::create([
            'user_id' => $user->id,
            'id_card' => $request->id_card,
            'zone_id' => $request->zone,
        ]);
        }
        catch(Exception $e){
            echo $e->getMessage();
        }
        

        return redirect('/user');
    }

    public function show($id)
    {
    }
  
    public function edit(k$id)
    {
       $user = User::find($id);
       $zones = $this->zones;
       $data = [
            'user' => $user,
            'zones' => $zones,
            'roles' => 1
        ];

        // return $data;
        return view('_user.edit',$data);
    }

    public function update(Request $request, $id)
    {
        $user = [
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'email' => $request->email,
            'role' => $request->role,
        ];

        $employee = [
            'id_card' => $request->id_card,
            'zone_id' => $request->zone,   
        ];

        if($request->password != null){
           $user['password'] = bcrypt($request->password);
         }
        User::find($request->id)->update($user);
        Employee::where('user_id', '=', $id)->update($employee);
         return redirect('user');

    }
  
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect('/user');
    }
}
