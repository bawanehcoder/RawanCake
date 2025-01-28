<?php

namespace App\Http\Requests\Site;

use App\Models\Traits\TranslateValidationErrorAttributesTrait;
use Illuminate\Foundation\Http\FormRequest;


class LoginUserRequest extends FormRequest
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
            'email' => ['required', 'string', 'email', 'exists:users',],
            'password' => ['required', 'string'],
        ];
    }
}
