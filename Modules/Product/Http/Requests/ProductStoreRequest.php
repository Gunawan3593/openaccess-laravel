<?php

namespace Modules\Product\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|unique:products',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'qty' => 'required|numeric'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name is required.',
            'name.string' => 'Name must be string.',
            'name.unique' => 'Name must be unique.',
            'description.required' => 'Description is required.',
            'description.string' => 'Description must be string.',
            'price.required' => 'Price is required.',
            'price.numeric' => 'Price must be numeric.',
            'qty.required' => 'Qty is required.',
            'qty.numeric' => 'Qty must be numeric.'
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
