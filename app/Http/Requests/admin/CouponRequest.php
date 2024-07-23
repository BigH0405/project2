<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class CouponRequest extends FormRequest
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
            'code'=>'required|unique:Coupons,code',
            'user_id'=>'required',
            'discount'=>'required|numeric|min:0',
            'quantily'=>'required|numeric|min:0',
            'start_day'=> 'required|date|after_or_equal:today',
            'end_day'=> 'required|date|after_or_equal:start_day',
        ];
    }
    public function messages(){
        return[
            'code.required'=>'Mã giảm giá không được bỏ trống',
            'user_id.required'=>'id khách không được bỏ trống',
            'code.unique'=>'Mã giảm giá đã tồn tại',
            'discount.required'=>'Giá không được để trống',
            'discount.numeric'=>'Giá phải là số',
            'discount.min'=>'Giá phải lớn hơn 0',
            'quantily.required'=>'Số lượng không được để trống',
            'quantily.numeric'=>'Số lượng phải là số',
            'quantily.min'=>'Số lượng phải lớn hơn 0',
            'start_day.required'=>'Thời gian không được để trống',
            'start_day.date'=>'Giữ liệu phải là thời gian',
            'start_day.after_or_equal'=>'Thời gian phải lớn hơn hoặc bằng hiện tại',
            'end_day.required'=>'Thời gian không được để trống',
            'end_day.date'=>'Giữ liệu phải là thời gian',
            'end_day.after_or_equal'=>'Thời gian phải lớn hơn hoặc bằng thời gian bắt đầu',

        ];
    }
}
