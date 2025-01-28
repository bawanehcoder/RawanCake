<?php

namespace App\Http\Requests\Admin;

use App\Models\Traits\TranslateValidationErrorAttributesTrait;
use Illuminate\Foundation\Http\FormRequest;


class BannerRequest extends FormRequest
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


            'image'=>"required_without:id|array",
            'image.*' => [
                'required',
                'file',
                'mimes:jpg,jpeg,JPG,png,gif',
                'max:' . 50 * 1024,

            ],

            'title'=>"nullable|string|min:1|max:250",
            // 'url'=>"nullable|url|min:1|max:250",
            'point'=>"nullable|integer|min:0|max:100",
            // 'start_at'=>"required|date",
            // 'ends_at' => 'date|after:start_at',

        ];
    }
}
