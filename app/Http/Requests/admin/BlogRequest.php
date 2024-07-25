<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
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
            'title' => 'required',
            'image' => 'required',
            'views' => 'required|numeric|min:0',
            'user_id' => ['required', 'integer' ,function($atribute, $value, $fail){
                if($value==0){
                    $fail('Vui lòng chọn nhóm');
                }
            }],
            'blog_id' => 'required',
            'short_description' => 'required',
            'description' => 'required',
        ];
    }

    public function messages(){
        return [
            'title.required' => 'Mô tả không được để trống',
            'image.required' => 'Ảnh không được để trống',
            // 'image.mimes'=>'Sai định dạng ảnh',
            'views.required' => 'Lượt xem không được để trống',
            'views.numeric' => 'Lượt xem phải là 0',
            'views.min' => 'Lượt xem phải lớn hơn 1',
            'user_id.required'=>'Nhóm không được bỏ trống',
            'blog_id.required' => 'Danh mục bài viết không được bỏ trống ',
            'short_description.required' => 'Mô tả ngắn không được bỏ trống',
            'description.required' => 'Miêu tả dài không được bỏ trống',

        ];
    }
}
