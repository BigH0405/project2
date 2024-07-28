<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
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
            'messege'=> 'required|max:255',
            
        ];
    }
    public function messages(){
        return[
            'messege.required'=>'Đánh giá không được để trống',
            'messege.max'=>'Đánh giá không được quá 255 kí tự',

        ];
    }
}
