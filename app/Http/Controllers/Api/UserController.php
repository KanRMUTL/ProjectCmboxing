<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\marketing\EmployeeUpdateRequest;
use App\Http\Requests\marketing\PasswordResetRequest;
use App\Http\Requests\shopping\CustomerUpdateRequest;
use Validator;
use App\MyClass\pos\ImageClass;
use App\marketing\Employee;
use App\User;

class UserController extends Controller
{
    public function store(EmployeeUpdateRequest $request, $id)
    {
        $user = User::find($id);
        $employee = Employee::where('user_id', '=', $id)->first();

        $user_data = [
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
        ]; 
        
        if($request->hasFile('img')){ 
            $objImage = new ImageClass('user', $request->file('img'));
            $objImage->originalName = $user->img;
            $objImage->updateImage();
            $user_data['img'] = $objImage->imageName;
        }
        $emp_data = [
            'id_card' => $request->id_card
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

    public function passwordReseted(PasswordResetRequest $request, $id) 
    {
        $data = [];
        $user = User::find($id);
        
        if($user->checkPass($request->oldPassword))
        {
            $user->update(['password'=> (bcrypt($request->password))]);
            $data['status'] = true;
            $user->role != 4 ? $data['message'] = 'เปลี่ยนรหัสผ่านสำเร็จ' : $data['message'] = 'Password updated';
           
            
        }
        else {
            $data['status'] = false;
            $user->role != 4 ? $data['message'] = 'รหัสผ่านเก่าไม่ถูกต้อง' : $data['message'] = 'Your Password is wrong';
        } 
        return response()->json($data);
        // return response()->json(['password' => $user->password, 'errors' => $validator->errors()]);
        // return response()->json(['message' => 'reset password successfully']);
    }

    public function showCustomer($id)
    {
        $user = User::find($id);
        return response()->json($user);
    }

    public function updateCustomer(CustomerUpdateRequest $request,$id)
    {
        $customer = User::find($id);
        $customer->update(request(['firstname', 'lastname', 'email', 'phone_number', 'address']));
        return response()->json(['message' => 'update profile complete']);
    }

}
