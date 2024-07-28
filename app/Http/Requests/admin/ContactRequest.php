<?php

namespace App\Http\Requests\admin;

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
            'email'=>'required|email|unique:users,email',
            'phone'=>['required', 'regex:/^[0-9]{10,15}$/'],
            'message'=>'required|min:0|max:255',
            'user_id'=>'required',
        ];
    }
    public function messages(){
        return[
            'fullname.required'=>'Họ và Tên không được để trống',
            'email.required'=>'Email không được để trống',
            'email.email'=>'Email sai định dạng',
            'email.unique'=>'Email đã được sử dụng',
            'phone.required' => 'Số điện thoại không được để trống',
            'phone.regex' => 'Số điện thoại không đúng định dạng',
            'user_id.required'=>'User_idkhông được để trống',

        ];
    }
}
