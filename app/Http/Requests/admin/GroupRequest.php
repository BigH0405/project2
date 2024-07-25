<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class GroupRequest extends FormRequest
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
            'permissions' => 'required'
        ];
    }

    public function messages(){
        return [
          'name.required' => 'Tên không được để trống',
          'permissions.required' => 'Quyền hạn không được để trống',
    ];
    }
}