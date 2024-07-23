<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        return  [
            'name' => 'required|unique:products,name',
            'price'=> 'required|numeric|min:0',
            'product_category'=>'required',
            'image'=>'required|mimes:png,jpg,jpge,webp',
            'quanlity'=>'required|numeric|min:0',
            'short_description'=>'required',
            'description'=>'required',
            'create_at',
            'update_at'
        ];
    }

    public function messages(){
        return [
           'name.required' => 'Tên sản phẩm không được để trống',
           'name.unique' => 'Tên sản phẩm đã tồn tại',
           'price.required'=>'Giá tiền không được để trống',
           'price.numeric'=>'Giá tiền phải là số',
           'price.min'=>'Giá tiền phải lớn hơn 0',
           'image.required'=>'Ảnh không được để trống',
           'image.mimes'=>'Sai định dạng ảnh',
           'quanlity.required'=>'Số lượng không được để trống',
           'quanlity.numeric'=>'Số lượng phải là số',
           'quanlity.min'=>'Số lượng phải lớn hơn 0',
           'price_sale.required' => 'Giá không được để trống',
           'product_category.required' => 'Danh mục sản phẩm không được để trống',
           'short_description.required' => 'Mô tả không được để trống',
           'description.required' => 'Mô tả không được để trống',

    ];
    }
}
