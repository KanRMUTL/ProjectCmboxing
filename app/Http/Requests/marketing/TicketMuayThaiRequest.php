<?php

namespace App\Http\Requests\marketing;

use Illuminate\Foundation\Http\FormRequest;

class TicketMuayThaiRequest extends FormRequest
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
            'name' => 'required|min:1|max:30',
            'price' => 'required|numberic',
            'commission' => 'required|numeric',
        ];
    }

    public function messages() {
        return [
            'required' => 'คุณยังไม่ได้ป้อนข้อมูล',
            'numeric' => 'กรุณากรอกตัวเลข',
        ];
    }
}
