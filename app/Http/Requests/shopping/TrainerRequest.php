<?php

namespace App\Http\Requests\shopping;

use Illuminate\Foundation\Http\FormRequest;

class TrainerRequest extends FormRequest
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
            'name' => 'required|min:8|max:30',
            'detail' => 'required|min:10',
            'img' => 'image'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'กรุณาป้อนข้อมูลให้ครบ',
            'name.min' => 'ชื่อครูฝึกต้องความยาว 8 - 30 ตัวอักษร',
            'name.max' => 'ชื่อครูฝึกต้องความยาว 8 - 30 ตัวอักษร',
            'detail.min' => 'รายละเอียดของครูฝึกต้องความยาวอย่างน้อย 10 ตัวอักษร',
            'img.image' => 'กรุณาเลือกไฟล์ที่เป็นรูปภาพ',
        ];
    }
}
