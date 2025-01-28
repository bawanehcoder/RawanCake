<?php

namespace App\Http\Requests\Admin;

use App\Models\Traits\TranslateValidationErrorAttributesTrait;
use Illuminate\Foundation\Http\FormRequest;


class PagesRequest extends FormRequest
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
            'title' => 'required|string|max:400',
            'route_name' => 'required|string|max:100|unique:pages',
            'arabic_content' => 'nullable|string|required_without:english_content|string|max:32000',
            'english_content' => 'nullable|string|required_without:arabic_content|string|max:32000',
        ];
    }
}
