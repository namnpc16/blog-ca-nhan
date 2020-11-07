<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePostRequest extends FormRequest
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
            'category_id' => 'required',
            'title' => 'required|unique:post',
            'author' => 'required',
            'status' => 'required',
            'img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'category_id.required' => 'không được để trống !',
            'title.required' => 'không được để trống !',
            'author.required' => 'không được để trống !',
            'status.required' => 'không được để trống !',
            'img.required' => 'không được để trống !',
            'description.required' => 'không được để trống !',
            'title.unique' => 'đã tồn tại !',
            'img.image' => 'không phải là file ảnh !',
            'img.mimes' => 'không được để trống !',
            'img.max' => 'vượt quá ký tự cho phép !',
        ];
    }
}
