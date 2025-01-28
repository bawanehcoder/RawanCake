<?php

namespace App\Http\Requests\Admin;

use App\Models\Traits\TranslateValidationErrorAttributesTrait;
use Illuminate\Foundation\Http\FormRequest;


class UpdateCategoriesOccasionRequest extends FormRequest
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
            'name_ar'=>"required|string|min:3|max:150",
            'name_en'=>"required|string|min:3|max:150",
            'category_image'=>"required_without:id|mimes:jpg,jpeg,png,gif",
        ];
    }
}
