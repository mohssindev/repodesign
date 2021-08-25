<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductFormRequest extends FormRequest
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
            'name'        => 'required|min:3|max:255',
            'description' => 'max:255',
            'price'       => 'required|numeric|min:0|max:100000',
            'image'       => 'required|mimes:jpg,jpeg,png|max:2048',
            'category_id' => 'required|numeric|exists:App\Models\Category,id'
        ];
    }
}
