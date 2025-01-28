<?php

namespace App\Http\Requests\Site;

use App\Models\Traits\TranslateValidationErrorAttributesTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class RedirectToProviderRequest extends FormRequest
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
            'guard' => ['required', Rule::in(config('socialLogin.guards')),],
            'provider' => ['required', Rule::in(config('socialLogin.allowed_providers'))],
        ];
    }
}
