<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class PromotionsRequest extends FormRequest
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
            'name' => 'required',
            'discount' => 'required|numeric|min:0',
            'quantity' => 'required|numeric|min:0',
            'start_day' => 'required|date|after_or_equal:today',
            'end_day' => 'required|date|after_or_equal:start_day',
            'status'=> 'required'
        ];
    }

    public function messages(){
        return [
           'name.required' => 'Tên danh mục không được để trống',
           'discount.required' => 'Số tiền giảm giá không được để trống',
           'discount.numeric' => 'Dữ liệu nhập vào không phải là số',
           'discount.min' => 'Sô tiền phải lớn hơn :min',
           'quantity.required'=> 'Số lượng không được để trống',
           'quantity.numeric'=> 'Dữ liệu nhập vào không phải là số',
           'quantity.min'=> 'Sô lượng phải lớn hơn :min',
           'start_day.required'=> 'Thời gian không được để trống',
           'start_day.date' => 'Dữ liệu bạn nhập vào không phải thời gian',
           'start_day.after_or_equal'=>'Ngày phải >= ngày hiện tại',
           'end_day.required'=> 'Thời gian không được để trống',
           'end_day.date' => 'Dữ liệu bạn nhập vào không phải thời gian',
           'end_day.after_or_equal'=>'Ngày phải >= ngày hiện tại',
           'status.required'=>'Trạng thái không được để trống'




    ];
    }
}
