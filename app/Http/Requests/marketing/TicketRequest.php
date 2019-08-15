<?php

namespace App\Http\Requests\marketing;

use Illuminate\Foundation\Http\FormRequest;

class TicketRequest extends FormRequest
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
            'userId' => 'required',
            'customerName' => 'required|min:1|max:30',
            'customerPhone' => 'required|min:9|max:10',
            'customerRoom' => 'required|min:1|max:10',
            'guesthouseId' => 'required',
            'visitDay' => 'required',
            'saleTypeId' => 'required',
            'ticketId' => 'required',
            'amount' => 'required|min:1|max:2'
        ];
    }

    public function messages() 
    {
        return [
            'required' => 'กรุณาป้อนข้อมูลให้ครบถ้วน',
            'customerName.min' => 'ชื่อของลูกค้าต้องมีความยาว 9 - 30 ตัวอักษร',
            'customerName.max' => 'ชื่อของลูกค้าต้องมีความยาว 9 - 30 ตัวอักษร',
            'customerPhone.min' => 'เบอร์โทรศัพท์ของลูกค้าต้องมีความยาว 9 - 10 ตัวอักษร',
            'customerPhone.max' => 'เบอร์โทรศัพท์ของลูกค้าต้องมีความยาว 9 - 10 ตัวอักษร',
            'customerRoom.min' => 'หมายเลขห้องลูกค้าต้องมีความยาว 1 - 10 ตัวอักษร',
            'customerRoom.max' => 'หมายเลขห้องลูกค้าต้องมีความยาว 1 - 10 ตัวอักษร',
            'amount.min' => 'จำนวนบัตรที่ขายต้องมีตัวเลข 1 - 2 หลัก',
            'amount.max' => 'จำนวนบัตรที่ขายต้องมีตัวเลข 1 - 2 หลัก',
        ];
    }
}
