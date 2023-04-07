<?php

namespace App\Http\Requests;

use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePaymentRequest extends FormRequest
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
            'details' => 'filled|array'
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->whenFilled('details', function ($details) {
            if (! is_array($details)) {
                $this->merge(['details' => Json::decode($details)]);
            }
        });
    }
}
