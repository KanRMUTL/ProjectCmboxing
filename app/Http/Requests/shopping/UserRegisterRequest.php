<?php

namespace App\Http\Requests\shopping;

use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
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
            'img' => 'required|image',
            'username' => 'required|unique:users,username|min:4|max:10',
            'firstname' => 'required|min:4|max:30',
            'lastname' => 'required|min:4|max:30',
            'email' => 'required|unique:users,email|max:30',
            'phone_number' => 'required|min:9|max:10',
            'address' => 'required',
            'password' => 'required|confirmed|min:8',
            'password_confirmation' => 'required|min:8',
        ];
    }
}
