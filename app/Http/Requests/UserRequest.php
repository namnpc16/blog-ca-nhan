<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'level' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'không được để trống !',
            'email.required' => 'không được để trống !',
            'email.email' => 'phải là email !',
            'email.unique' => 'đã được sử dụng !',
            'password.required' => 'không được để trống !',
            'level.required' => 'không được để trống !',
        ];
    }
}
