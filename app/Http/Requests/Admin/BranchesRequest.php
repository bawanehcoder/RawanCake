<?php

namespace App\Http\Requests\Admin;

use App\Models\Traits\TranslateValidationErrorAttributesTrait;
use Illuminate\Foundation\Http\FormRequest;


class BranchesRequest extends FormRequest
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
            'Phone'=>"required|regex:/^([0-9\s\-\+\(\)]*)$/|min:8|max:15",
            'Map'=>"nullable|string|min:50|max:500",
        ];
    }
}
