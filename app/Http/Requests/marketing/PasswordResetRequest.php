<?php

namespace App\Http\Requests\marketing;

use Illuminate\Foundation\Http\FormRequest;

class PasswordResetRequest extends FormRequest
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
            'oldPassword' => 'required',
            'password' => 'required|min:8|confirmed',
        ];
    }


    // public function messages()
    // {
    //     return [
    //         'required' => 'คุณยังไม่ได้ป้อนข้อมูล',
    //         'password.min' => 'รหัสผ่านต้องมีอย่างน้อย 8 ตัวอักษร',
    //         'password.confirmed' => 'รหัสผ่านไม่ตรงกัน'
    //     ];
    // }

}
