<?php

namespace App\Http\Requests\Admin;

use App\Models\Traits\TranslateValidationErrorAttributesTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class DiscountRequest extends FormRequest
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
            'categories'=>"required|array|min:1",
            'discount'=>"required|integer|min:1|max:100",
            'beginning_of_reservation' => 'required|date',
            'end_of_reservation' => 'date|after:beginning_of_reservation',
            'beginning_of_receipt' => 'required|date',
            'end_of_receipt' => 'date|after:beginning_of_receipt',
        ];
    }
}
