<?php

namespace App\Http\Requests\shopping;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
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
            'name' => 'required|min:4|max:30',
            'price' => 'required|numeric',
            'detail' => 'required|min:10'
        ];
    }

    public function messages() 
    {
        return  [
            'required' => 'คุณยังไม่ได้ป้อนข้อมูล',
            'name.min' => 'ชื่อคอร์สฝึกสอนต้อง 4 - 30 ตัวอักษร',
            'name.max' => 'ชื่อคอร์สฝึกสอนต้อง 4 - 30 ตัวอักษร',
            'price.numeric' => 'ราคาคอร์สต้องเป็นตัวเลขเท่านั้น',
            'detail.min' => 'รายละเอียดคอร์สต้องมีอย่างน้อย 10 ตัวอักษร'
        ];
        
    }
}
