<?php

namespace App\Http\Requests\Admin;

use App\Models\Traits\TranslateValidationErrorAttributesTrait;
use Illuminate\Foundation\Http\FormRequest;


class ZonesRequest extends FormRequest
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

            'AddresAr'=>"required|string|min:3|max:500",
            'AddresEn'=>"required|string|min:3|max:500",
            'delivery'=>"required|array|min:6",
            'delivery.*'=>"required|regex:/^([0-9\s\.\-\+\(\)]*)$/|between:0,99.99",
        ];
    }
}
