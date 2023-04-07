<?php

namespace App\Http\Requests;

use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePaymentRequest extends FormRequest
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
            'type'    => ['required', Rule::in(['credit_card', 'cash_on_delivery', 'bank_transfer'])],
            'details' => 'required|array'
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        if (! is_array($this->details)) {
            $this->merge(['details' => Json::decode($this->details)]);
        }
    }
}
