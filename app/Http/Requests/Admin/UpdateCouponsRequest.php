<?php

namespace App\Http\Requests\Admin;

use App\Models\Traits\TranslateValidationErrorAttributesTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class UpdateCouponsRequest extends FormRequest
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

            'symbols'=>"required|string|min:3",
            'usage_limit'=>"required|integer|min:1",
            'expiration_date'=>"required|date|after:today",
            'FixedDiscount' => ['nullable',Rule::requiredIf(function () {
                return $this->input('RelativeDiscount') < '1';
            }),'numeric','between:0.1,99.99'],
            'RelativeDiscount' => ['nullable',Rule::requiredIf(function () {
                return $this->input('FixedDiscount') < '1';
            }),'integer','min:1','max:100'],
        ];
    }
}
