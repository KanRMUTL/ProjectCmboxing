<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\MyClass\pos\ImageClass;
use App\marketing\Employee;
use App\User;

class UserController extends Controller
{
    public function store(Request $request, $id)
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
        
        if($request->hasFile('img')){ 
            $objImage = new ImageClass('user', $request->file('img'));
            $objImage->originalName = $user->img;
            $objImage->updateImage();
            $user_data['img'] = $objImage->imageName;
        }
        $emp_data = [
            'id_card' => $request->idCard
        ];

        $user->update($user_data);
        $employee->update($emp_data);

        return response()->json([$user_data, $employee]);
    }

    public function show($id)
    {
        $user = User::join('employees', 'users.id', '=', 'employees.user_id')->where('users.id', '=', $id)->get();
        return response()->json($user);
    }
}
