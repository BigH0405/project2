<?php

namespace App\Http\Requests\client;

use Illuminate\Foundation\Http\FormRequest;

class BillRequest extends FormRequest
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
            'name'=> 'required',
            'address'=> 'required',
            'email'=>'required|email',
            'phone'=>['required', 'regex:/^[0-9]{10,15}$/'],
        ];
    }
    public function messages(){
        return[
            'name.required'=>'Họ và Tên không được để trống',
            'address.required'=>'Địa chỉ không được để trống',
            'email.required'=>'Email không được để trống',
            'email.email'=>'Email sai định dạng',
            'phone.required' => 'Số điện thoại không được để trống',
            'phone.regex' => 'Số điện thoại không đúng định dạng',

        ];
    }
}
