<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'fullname' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'confirm_password' => 'required|min:8|same:password',
            'phone' => ['required', 'regex:/^[0-9]{10,15}$/'],
            'address'=> 'required',
            'role' => 'required',
            'group_id' => ['required', 'integer' ,function($atribute, $value, $fail){
                if($value==0){
                    $fail('Vui lòng chọn nhóm');
                }
            }],
        ];
    }

    public function messages(){
        return [
          'fullname.required' => 'Họ và tên không được để trống',
          'email.required' => 'Email không được để trống',
          'email.email' => 'Email không đúng định dạng',
          'email.unique' => 'Email đã tồn tại',
          'password.required' => 'Mật khẩu không được để trống',
          'password.min' => 'Mật khẩu phải ít nhất 8 ký tự',
          'confirm_password.required' => 'Mật khẩu xác nhận không được để trống',
          'confirm_password.min' => 'Mật khẩu xác nhận phải ít nhất 8 ký tự',
          'confirm_password.same' => 'Mật khẩu xác nhận không trùng khớp với mật khẩu',
          'phone.required' => 'Số điện thoại không được để trống',
          'phone.regex' => 'Số điện thoại không đúng định dạng',
          'address.required' => 'Địa chỉ không được để trống',
          'role.required' => 'Trạng thái không được để trống',
          'group_id.required'=> 'Nhóm không được để trống',
          'group_id.integer'=> 'Nhóm phải là số',
    ];
    }
}
