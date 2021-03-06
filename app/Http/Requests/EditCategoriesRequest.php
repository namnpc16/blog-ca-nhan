<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditCategoriesRequest extends FormRequest
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
            'status' => 'required',
            'name' => 'required|max:255|unique:categories,name,' . $this->id,
        ];
    }

    public function messages()
    {
        return [
            'status.required' => 'không được để trống !',
            'name.required' => 'không được để trống !',
            'name.unique' => 'đã tồn tại !',
            'name.max' => 'quá ký tự cho phép !',
        ];
    }
}
