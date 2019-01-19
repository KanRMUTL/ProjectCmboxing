<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddUser extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'names' => 'required|string|max:30',
            'username' => 'required|string|max:10',
            'email' => 'required|email|max:30',
            'role' => 'required|string',
            'zone' => 'required|string',
            'password' => 'required|string',
            'confirm_password' => 'required|string'
        ];
    }

    public function messages()
    {
        return [
            'names.required' => 'กรุณากรอกชื่อ - นามสกุลด้วย',
            'username.required' => 'กรุณากรอกชื่อด้วย',
            'email.required' => 'กรุณากรอกอีเมล์',
            'role.required' => 'กรุณาเลือกตำแหน่งของผู้ใช้',
            'zone.required' => 'กรุณาเลือกโซนของผู้ใช้',
            'password.required' => 'กรุณากรอกรหัสผ่าน',
            'confirm_password.required' => 'กรุณากรอกข้อมูลการยืนยันรหัสผ่าน',
            'name.string' => 'ชื่อ - นามสกุลต้องเป็นตัวอักษรเท่านั้น',
            'username.string' => 'ชื่อผู้ใช้ต้องเป็นตัวหนังสือเท่านั้น',
            
        ];
    }
}
