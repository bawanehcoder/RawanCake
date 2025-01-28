<?php

namespace App\Http\Requests\Site;

use App\Models\Traits\TranslateValidationErrorAttributesTrait;
use http\Client\Request;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class StorePaymentRequest extends FormRequest
{
    use TranslateValidationErrorAttributesTrait;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'payment_method' => [
                'required',
                Rule::in([
                    'cash_on_delivery',
                    'payment_by_credit_card',

                ]),
            ],
            'amount' => 'required|string|numeric|min:0|max:5000',
            'delivery_type' => [
                'required',
                Rule::in([
                    'personal_pickup',
                    'delivery_address',
                ]),
            ],
            // 'name' => 'required|string|min:2|max:250',
            'notes' => 'nullable|string|max:500',
            'phone_number' => ["required", "regex:/^([0-9\s\\-\+\(\)]*)$/"],
            'delivery_time' => 'required',
            // 'order_date' => 'required',

        ];
    }
}
