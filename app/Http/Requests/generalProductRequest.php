<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class generalProductRequest extends FormRequest
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
         $data = [
            'name' => 'required|min:5|max:100',
            'slug' => 'required|unique:Products,slug',
            'description' => 'required|max:1000',
            'short_description' => 'nullable|max:500',
            'categories' => 'array|min:1',
            'categories.*' => 'numeric|exists:categories,id',
            'brand_id'     => 'required|exists:brands,id'
        ];


        return $data;
    }
}
