<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class BlogCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'name' => 'required|unique:blog_category,name',
            'short_description' => 'required'
        ];
    }

    public function messages(){
        return [
            'name.required' => 'Tên danh mục bài viết không được để trống',
            'name.unique' => 'Tên danh mục bài viết đã tồn tại',
            'short_description.required' => 'Mô tả không được để trống'
        ];
    }
}
