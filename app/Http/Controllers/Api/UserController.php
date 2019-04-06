<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\marketing\Employee;
use App\User;

class UserController extends Controller
{
    public function index()
    {
        
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        
    }

    public function show($id)
    {
        $user = User::join('employees', 'users.id', '=', 'employees.user_id')->where('users.id', '=', $id)->get();
        return response()->json($user);
    }

    public function edit($id)
    {
        //
    }

  
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $employee = Employee::where('user_id', '=', $id)->first();
        $user_data = [
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'phone_number' => $request->phoneNumber,
            'address' => $request->address,
        ];
        // $user->password = $request->password;
        $emp_data = [
            'id_card' => $request->idCard
        ];

        $user->update($user_data);
        $employee->update($emp_data);

        return response()->json([$user, $employee]);
    }

    
    public function destroy($id)
    {
        //
    }
}
