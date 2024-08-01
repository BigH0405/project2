<?php

namespace App\Http\Requests\client;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'fullname'=> 'required',
            'email'=>'required|email',
            'phone'=>['required', 'regex:/^[0-9]{10,15}$/'],
            'message'=>'required|min:1|max:255',
        ];
    }
    public function messages(){
        return[
            'fullname.required'=>'Họ và Tên không được để trống',
            'email.required'=>'Email không được để trống',
            'message.required'=>'Liên hệ không được để trống',
            'message.min'=>'Phải nhiều hơn 1 ký tự',
            'message.max'=>'Ít hơn 255 ký tự',
            'email.email'=>'Email sai định dạng',
            'phone.required' => 'Số điện thoại không được để trống',
            'phone.regex' => 'Số điện thoại không đúng định dạng',

        ];
    }
}
