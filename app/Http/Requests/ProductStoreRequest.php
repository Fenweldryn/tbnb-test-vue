<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
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
            'products' => 'required|array',
            'products.*.name' => 'required_with:products.*|min:3',
            'products.*.price' => 'required_with:products.*|min:1',
            'products.*.quantity' => 'required_with:products.*|min:1'
        ];
    }

    // public function messages()
    // {
    //     return [
    //         'products.*.name.required_with' => 'The name field is required if any field is filled for form *',
    //         'products.*.price.required_with' => 'The price field is required if any field is filled for form *',
    //         'products.*.quantity.required_with' => 'The quantity field is required if any field is filled for form *'
    //     ];
    // }
}
