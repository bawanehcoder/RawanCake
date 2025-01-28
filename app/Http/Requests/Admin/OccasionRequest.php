<?php

namespace App\Http\Requests\Admin;

use App\Models\Traits\TranslateValidationErrorAttributesTrait;
use Illuminate\Foundation\Http\FormRequest;


class OccasionRequest extends FormRequest
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
            'title_ar'=>"required|string|min:3|max:150",
            'title_en'=>"required|string|min:3|max:150",
            'description_ar'=>"required|string|min:20|max:1000",
            'description_en'=>"required|string|min:20|max:1000",
        ];
    }
}
