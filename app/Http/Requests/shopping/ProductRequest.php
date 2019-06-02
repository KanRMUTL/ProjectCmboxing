<?php

namespace App\Http\Requests\shopping;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'barcode' => 'required|min:13|max:13',
            'name' => 'required|min:1|max:30',
            'price' => 'required|numeric',
            'unit' => 'required|min:1|max:30',
            'amount' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'คุณยังไม่ได้ป้อนข้อมูล',
            'barcode.min' => 'บาร์โค้ดสินค้าต้องมีจำนวนตัวเลข 13 หลัก',
            'barcode.max' => 'บาร์โค้ดสินค้าต้องมีจำนวนตัวเลข 13 หลัก',
            'price.numeric' => 'กรุณาป้อนข้อมูลที่เป็นตัวเลข',
            'unit.min' => 'หน่วยเรียกสินค้าต้องมี 1 - 30 ตัวอักษร',
            'unit.max' => 'หน่วยเรียกสินค้าต้องมี 1 - 30 ตัวอักษร',
            'amount.numeric' => 'กรุณาป้อนข้อมูลที่เป็นตัวเลข',
        ];
        
    }
}
