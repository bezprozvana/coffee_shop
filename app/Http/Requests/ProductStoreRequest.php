<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'between:-99999999.99,99999999.99'],
            'description' => ['required', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'stock_quantity' => ['required', 'integer', 'min:0'],
            'brand_id' => ['required', 'integer', 'exists:brands,id'],
            'weight_id' => ['required', 'integer', 'exists:weights,id'],
            'country_id' => ['required', 'integer', 'exists:countries,id'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'acidity_level_id' => ['required', 'integer', 'exists:acidity_levels,id'],
            'sweetness_level_id' => ['required', 'integer', 'exists:sweetness_levels,id'],
            'bitterness_level_id' => ['required', 'integer', 'exists:bitterness_levels,id'],
            'processing_method_id' => ['required', 'integer', 'exists:processing_methods,id'],
        ];
    }

}
