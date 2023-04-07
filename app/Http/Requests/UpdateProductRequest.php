<?php

namespace App\Http\Requests;

use App\Models\Category;

class UpdateProductRequest extends StoreProductRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'category_uuid' => 'filled|exists:categories,uuid',
            'title'         => 'filled',
            'price'         => 'filled',
            'description'   => 'filled',
            'metadata'      => 'filled',
        ];
    }

    /**
     * Handle a passed validation attempt.
     */
    public function passedValidation(array $keys = null): void
    {
        $this->whenFilled('category_uuid', function () {
            $this->merge([
                'category_id' => Category::whereUuid($this->category_uuid)->withTrashed()->value('id')
            ]);
        });
    }
}
