<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class subCategoryReq extends FormRequest
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
            'slug'=> 'required|unique:categories,slug,' . $this->id,
            'parent_id' => 'required|exists:categories,id'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'هذا الحقل مطلوب',
            'slug.required' => 'هذا الحقل مطلوب',
            'slug.unique' => 'هذا الاسم محجوز بالفعل',
            'parent_id.required' => 'يجب اختيار القسم الرئيسي',
            'parent_id.exists' => 'هذا القسم غير موجود'
        ];
    }
}
