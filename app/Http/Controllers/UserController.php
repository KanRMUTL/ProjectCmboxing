<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\marketing\EmployeeStoreRequest;
use App\Http\Requests\marketing\EmployeeUpdateRequest;
use App\Http\Controllers\marketing\StarterController;
use App\MyClass\pos\ImageClass;
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
     
    public function store(EmployeeStoreRequest $request)
    {
        $objImage = new ImageClass('user', $request->file('img'));
        $objImage->uploadImage();
        
        $user = User::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'username' => $request->username,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'img' =>  $objImage->imageName,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);
       
        $employee = Employee::create([
            'user_id' => $user->id,
            'id_card' => $request->id_card,
            'zone_id' => $request->zone_id,
        ]);
       
        return back();
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
                    'roles' => ['2' => 'หัวหน้าฝ่ายการตลาด', '3' => 'พนักงานฝ่ายการตลาด']
                ];
                return view('marketing._user.edit',$data);
        } 
        catch(Exception $e)
        {
            return $e;
        } 
    }

    public function update(EmployeeUpdateRequest $request, $id)
    {
        $user = User::find($request->user_id);
        $data = [ 
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'email' => $request->email,
            'role' => $request->role
        ];
        if($request->hasFile('img')){ 
            $objImage = new ImageClass('user', $request->file('img'));
            $objImage->originalName = $user->img;
            $objImage->updateImage();
            $data['img'] = $objImage->imageName;
        }

        $employee = [
            'id_card' => $request->id_card,
            'zone_id' => $request->zone,   
        ];

        if($request->new_password != null){
           $data['password'] = bcrypt($request->new_password);
         } 
        $user->update($data);
        Employee::where('user_id', '=', $request->user_id)->update($employee);
        return redirect('user');

    }
  
    public function destroy($id)
    {
        User::find($id)->delete();
        Employee::where('user_id', $id)->delete();

        return back();
    }

    public function resetpassword()
    {
        return view('marketing._profile.reset_password');
    }

    
}
