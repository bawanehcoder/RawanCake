<?php

namespace App\Http\Requests\Admin;

use App\Models\Traits\TranslateValidationErrorAttributesTrait;
use Illuminate\Foundation\Http\FormRequest;


class GenralInfoRequest extends FormRequest
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
            'EMail' => ['nullable', 'string', 'email', 'max:255'],
            'Facebook' => ['nullable', 'url'],
            'Twitter' => ['nullable', 'url'],
            'LinkedIn' => ['nullable', 'url'],
            'Instagram' => ['nullable', 'url'],
            'YouTube' => ['nullable', 'url'],
            'Pinterest' => ['nullable', 'url'],
            'FourSquare' => ['nullable', 'url'],
            'Tumblr' => ['nullable', 'url'],

        ];
    }
}
