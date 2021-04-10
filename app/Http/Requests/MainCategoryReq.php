<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MainCategoryReq extends FormRequest
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
            'name' => 'required',
            'is_active' => 'required|in:1,2' ,
            'slug'=> 'required|unique:categories,slug,' . $this->id,

        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'هذا الحقل مطلوب',
            'slug.required' => 'هذا الحقل مطلوب',
            'slug.unique' => 'هذا الاسم محجوز بالفعل'
        ];
    }
}
