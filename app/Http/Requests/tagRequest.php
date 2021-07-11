<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class tagRequest extends FormRequest
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
