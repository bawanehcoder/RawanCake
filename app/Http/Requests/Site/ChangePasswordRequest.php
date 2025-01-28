<?php

namespace App\Http\Requests\Site;

use App\Models\Traits\TranslateValidationErrorAttributesTrait;
use Illuminate\Foundation\Http\FormRequest;


class ChangePasswordRequest extends FormRequest
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
        $rules = [
            'new_password' => 'required|string|max:50|confirmed',
        ];


        if (!empty(getLogged()->password)) {
            $rules['old_password'] = 'required|string|max:50';
        }

        return $rules;
    }
}
