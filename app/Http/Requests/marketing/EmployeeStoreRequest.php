<?php

namespace App\Http\Requests\marketing;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeStoreRequest extends FormRequest
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
            'firstname' => 'required|min:4|max:30',
            'lastname' => 'required|min:4|max:30',
            'username' => 'required|unique:users,username|min:4|max:10',
            'id_card' => 'required|min:13|max:13',
            'email' => 'required|unique:users,email|max:30',
            'phone_number' => 'required|min:9|max:10',
            'address' => 'required',
            'role' => 'required',
            'zone_id' => 'required',
            'address' => 'required',
            'img' => 'image',
            'password' => 'required|confirmed|min:8',
            'password_confirmation' => 'required|min:8',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'คุณยังไม่ได้ป้อนข้อมูล',
            'firstname.min' => 'ชื่อพนักงานต้องมีความยาว  4 - 30 ตัวอักษร',
            'firstname.max' => 'ชื่อพนักงานต้องมีความยาว  4 - 30 ตัวอักษร',
            'lastname.min' => 'ชื่อพนักงานต้องมีความยาว  4 - 30 ตัวอักษร',
            'lastname.max' => 'ชื่อพนักงานต้องมีความยาว  4 - 30 ตัวอักษร',
            'username.unique' => 'username ดังกล่าวถูกใช้ไปแล้ว',
            'id_card.min' => 'รหัสบัตรประชาชนต้องมีตัวเลขจำนวน 13 หลัก',
            'id_card.max' => 'รหัสบัตรประชาชนต้องมีตัวเลขจำนวน 13 หลัก',
            'email.unique' => 'อีเมล์นี้ถูกใช้ไปแล้ว',
            'email.max' => 'อีเมล์ต้องมีความยาวไม่เกิน 30 ตัวอักษร',
            'phone_number.min' => 'เบอร์โทรศัพท์ต้องตัวเลข 9 - 10 หลัก',
            'phone_number.max' => 'เบอร์โทรศัพท์ต้องตัวเลข 9 - 10 หลัก',
            'img.image' => 'กรูณาเลือกไฟล์ที่เป็นรูปภาพ',
            'password.confirmed' => 'รหัสผ่านไม่ตรงกัน',
            'password.min' => 'รหัสผ่านต้องมีความยาวอย่างน้อย 8 ตัวอักษร',
            'password_confirmation.min' => 'รหัสผ่านต้องมีความยาวอย่างน้อย 8 ตัวอักษร',
        ];
    }
}
