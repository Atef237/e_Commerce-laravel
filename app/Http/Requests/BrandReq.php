<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BrandReq extends FormRequest
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
            'name' => 'required|unique:brands.name',
            'photo' => 'required|mimes:jpg,jpeg,png'
        ];

    }
    public function messages()
    {
        return [
            'name.required' => 'اسم الماركة مطلوب',
            'name.unique' => ' هذه الماركة موجوده بالفعل',
            'photo.required' => 'انت لم تختار صورة "الصورة مطلوبة"',
            'photo.mimes' => 'هذه الصيغة ليست مدعومة'
        ];
    }
}
