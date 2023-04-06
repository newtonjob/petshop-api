<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
            'first_name'   => 'filled',
            'last_name'    => 'filled',
            'email'        => ['email', Rule::unique('users')->ignore($this->user)],
            'phone_number' => 'filled|unique:users',
            'password'     => 'confirmed|min:5',
            'address'      => 'string',
            'is_marketing' => 'bool',
        ];
    }
}
