<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'name' => ['required', 'string'],
            'phone_number' => ['nullable', 'string', 'unique:users,phone_number'],
            'email' => ['required', 'email', 'unique:users,email'],
            'email_verified_at' => ['nullable'],
            'password' => ['required', 'password'],
            'is_admin' => ['required'],
            'remember_token' => ['required', 'string'],
            'deleted_at' => ['nullable'],
        ];
    }
}
