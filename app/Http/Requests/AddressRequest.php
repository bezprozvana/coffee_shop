<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
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
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'full_name' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'region' => ['required', 'string', 'max:255'],
            'postal_code' => ['required', 'string', 'max:20'],
            'address_line' => ['required', 'string', 'max:500'],
            'is_default' => ['sometimes', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'full_name.required' => 'Будь ласка, вкажіть повне ім\'я',
            'city.required' => 'Будь ласка, вкажіть місто',
            'region.required' => 'Будь ласка, вкажіть область',
            'postal_code.required' => 'Будь ласка, вкажіть поштовий індекс',
            'address_line.required' => 'Будь ласка, вкажіть адресу',
        ];
    }
}
