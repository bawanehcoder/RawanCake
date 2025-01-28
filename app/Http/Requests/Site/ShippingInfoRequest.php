<?php

namespace App\Http\Requests\Site;

use App\Models\Traits\TranslateValidationErrorAttributesTrait;
use Illuminate\Foundation\Http\FormRequest;


class ShippingInfoRequest extends FormRequest
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
            'zone' => "required|exists:zones,id",
            'title' => ['required', 'string', 'min:3', 'max:255'],
            'shipping_info' => ['nullable'],
            'phone' => ["required", "regex:/^([0-9\s\\-\+\(\)]*)$/"],
        ];
    }
}
