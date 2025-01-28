<?php

namespace App\Http\Requests\Site;

use App\Models\Traits\TranslateValidationErrorAttributesTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class UpdateUserRequest extends FormRequest
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
            'name' => ['nullable', 'string', 'min:3', 'max:255'],
            'gender' => ['nullable', 'integer', 'min:0', 'max:1'],
            'phone' => ["nullable", "regex:/^([0-9\s\\-\+\(\)]*)$/", Rule::unique('users')->ignore(request()->id)],
            'birthDate' => 'nullable|date|date_format:Y-m-d',
            'marriageDate' => 'nullable|date|date_format:Y-m-d|before:today',
            'partnerBirthdate' => 'nullable|date|date_format:Y-m-d|before:today',
            'zone' => "nullable|exists:zones,id",
        ];
    }
}
