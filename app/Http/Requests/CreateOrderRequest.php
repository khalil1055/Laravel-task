<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'items' => 'required|array',
            'items.*.id' => 'required|integer|distinct',
            'items.*.quantity' => 'required|integer',
            'type' => 'string|required|in:delivery,dine_in,takeaway',
            //delivery rules
            'delivery_fees' => 'numeric|required_if:type,delivery',
            'customer_phone' => 'integer|required_if:type,delivery|required_with:customer_name',
            'customer_name' => 'required_if:type,delivery|required_with:customer_phone',
            //dine in rules
            'table_number' => 'required_if:type,dine_in',
            'service_charge' => 'numeric|required_if:type,dine_in',
            'waiter_name' => 'required_if:type,dine_in'
        ];
    }
}
