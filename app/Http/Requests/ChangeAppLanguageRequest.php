<?php

namespace App\Http\Requests;

use App\Models\Traits\TranslateValidationErrorAttributesTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ChangeAppLanguageRequest extends FormRequest
{
    use TranslateValidationErrorAttributesTrait;
    public function rules()
    {

        return [
            'lang' => ['required', 'string', 'max:2', Rule::in(config('core.available_languages'))]
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
