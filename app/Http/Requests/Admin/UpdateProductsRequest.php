<?php

namespace App\Http\Requests\Admin;

use App\Models\Traits\TranslateValidationErrorAttributesTrait;
use Illuminate\Foundation\Http\FormRequest;


class UpdateProductsRequest extends FormRequest
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
            'CatID'=>"required|integer|min:1",
            'main_product'=>"required_without:id|mimes:jpg,jpeg,png,gif",
            'product_ar'=>"required|string|min:3|max:50",
            'product_en'=>"required|string|min:3|max:50",
            'description_ar'=>"required|string|min:3|max:500",
            'description_en'=>"required|string|min:3|max:500",
            'price'=>"required|between:0,99.99",
        ];
    }
}
