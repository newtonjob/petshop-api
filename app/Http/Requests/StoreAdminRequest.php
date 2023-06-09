<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdminRequest extends FormRequest
{
    /**
     * Indicates whether validation should stop after the first rule failure.
     */
    protected $stopOnFirstFailure = true;

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
            'first_name'   => 'required',
            'last_name'    => 'required',
            'email'        => 'required|email|unique:users',
            'phone_number' => 'unique:users',
            'password'     => 'required|confirmed|min:5',
            'address'      => 'required',
            'is_marketing' => 'bool',
            'is_admin'     => 'bool',
        ];
    }

    /**
     * Handle a passed validation attempt.
     */
    protected function prepareForValidation(): void
    {
        $this->merge(['is_admin' => true]);
    }
}
