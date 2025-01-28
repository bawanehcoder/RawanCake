<?php

namespace App\Http\Requests\Site;

use App\Models\Traits\TranslateValidationErrorAttributesTrait;
use http\Client\Request;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class ShowPaymentFormRequest extends FormRequest
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
            'id' => [
                'nullable',
                Rule::exists('shipping_infos')->where(function ($query) {
                    $request = \Request();
                    $query->where('user_id', getLogged()->id)->where('id', $request->id);
                }),
            ]
        ];
    }
}
