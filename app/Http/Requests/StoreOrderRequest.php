<?php

namespace App\Http\Requests;

use App\Models\OrderStatus;
use App\Models\Payment;
use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
            'order_status_uuid'   => 'required|exists:order_statuses,uuid',
            'payment_uuid'        => 'required|exists:payments,uuid',
            'products'            => 'required|array',
            'products.*.uuid'     => 'required|exists:products',
            'products.*.quantity' => 'required|int|min:1',
            'address'             => 'required|array:billing,shipping'
        ];
    }

    /**
     * Handle a passed validation attempt.
     */
    public function passedValidation(array $keys = null): void
    {
        $this->merge([
            'order_status_id' => OrderStatus::whereUuid($this->order_status_uuid)->value('id'),
            'payment_id'      => Payment::whereUuid($this->payment_uuid)->value('id'),
        ]);
    }

    /**
     * The data needed to fulfill the request.
     */
    public function data(): array
    {
        return $this->only(['order_status_id', 'payment_id', 'address']);
    }

    /**
     * Get the product IDs to attach to the order with their quantity and price.
     */
    public function getProductsToAttach()
    {
        $products = Product::whereIn('uuid', $this->collect('products')->pluck('uuid'))->get();

        return $products->mapWithKeys(function ($product) {
            return [
                $product->id => [
                    'quantity' => $this->collect('products')
                        ->where('uuid', $product->uuid)
                        ->quantity,
                    'price'    => $product->price
                ]
            ];
        });
    }
}
