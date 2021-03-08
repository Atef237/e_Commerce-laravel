<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileReq extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

            'name'  => 'required',
            'email' => 'required|email|unique:admins,email, '.$this -> id,
            'password' => 'nullable|min:8|confirmed',

        ];
    }

    public function messages()
    {
        return [

            'name.required'         => 'يجب ادخال الاسم',
            'email.required'        => 'يجب ادخال البريد الالكتروني',
            'email.email'           => 'تاكد من قيمة البريد الالكتروني',
            'email.unique'          => 'هذا البريد موجود من قبل',
            'password.min:8'        => 'يجب الا تقل عن 8 حروف',
            'password.confirmed'    =>'كلمة المرور غير مطابقة',

        ];
    }
}
