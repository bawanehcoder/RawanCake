<?php

namespace App\Http\Requests\Admin;

use App\Models\Traits\TranslateValidationErrorAttributesTrait;
use Illuminate\Foundation\Http\FormRequest;


class UpdateMainCategoriesRequest extends FormRequest
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
            'category_image'=>"required_without:id|mimes:jpg,jpeg,png,gif",
            'section_title_ar'=>"required|string|min:3|max:50",
            'section_title_en'=>"required|string|min:3|max:50",
            'ShortcutName'=>"required|string|min:3|max:50",
            'ShortcutNameEN'=>"required|string|min:3|max:50",
            'SortIndex'=>"required|string|min:0|max:5000",
            'Visible'=>"required|string|min:0|max:1",
        ];
    }
}
