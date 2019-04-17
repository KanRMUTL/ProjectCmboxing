<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AddUser;
use App\Http\Controllers\marketing\StarterController;
use App\User;
use App\marketing\Employee;
use App\marketing\Role;
use App\marketing\Zone;
use Auth;

class UserController extends Controller
{

    private $zones;
    private $roles;
    public $starter;

    public function __construct()
    {
        $starter = new StarterController();
         $this->zones = Zone::all();
        //  $this->roles =  Auth::user()->role;
    }

    public function index()
    {
        $data['users'] = User::getUsers()->get();
        $data['zones'] =$this->zones;
        $data['roles'] = ['แอดมิน','หัวหน้าฝ่ายการตลาด', 'พนักงานฝ่ายการตลาด'];
        return view('marketing._user.index',$data);
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
        return view('marketing._user.profile');
    }
  
    public function edit($id)
    { 
        try
        {
            $user = User::find($id);
            $zones = $this->zones;
            $data = [
                    'user' => $user,
                    'zones' => $zones,
                    'roles' => ['แอดมิน','หัวหน้าฝ่ายการตลาด', 'พนักงานฝ่ายการตลาด']
                ];
                return view('marketing._user.edit',$data);
        } 
        catch(Exception $e)
        {
            return $e;
        } 
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
        User::find($request->user_id)->update($user);
        Employee::where('user_id', '=', $request->user_id)->update($employee);
        return redirect('user');

    }
  
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect('/user');
    }
}
