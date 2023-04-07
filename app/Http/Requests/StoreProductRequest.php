<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'category_uuid' => 'required|exists:categories,uuid',
            'title'         => 'required',
            'price'         => 'required',
            'description'   => 'required',
            'metadata'      => 'required',
        ];
    }

    /**
     * Handle a passed validation attempt.
     */
    public function passedValidation(array $keys = null): void
    {
        $this->merge([
            'category_id' => Category::whereUuid($this->category_uuid)->value('id')
        ]);
    }

    /**
     * The data needed to fulfill the request.
     */
    public function data(): array
    {
        return $this->only(['title', 'category_id', 'price', 'description', 'metadata']);
    }
}
