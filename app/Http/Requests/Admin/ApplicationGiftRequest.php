<?php

namespace App\Http\Requests\Admin;

use App\Models\Traits\TranslateValidationErrorAttributesTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class ApplicationGiftRequest extends FormRequest
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
        $request = \Request();
        $rules =  [
            'gift_message'=>"required|string|min:0|max:500",
            'product'=>"nullable|exists:items,id",
        ];

        if($request->type_of_gift==0){
            $rules[ 'FixedDiscount'] = ['nullable',Rule::requiredIf(function () {
                return $this->input('RelativeDiscount') < '1';
            }),'numeric','between:0.1,99.99'];
            $rules['RelativeDiscount'] = ['nullable',Rule::requiredIf(function () {
                return $this->input('FixedDiscount') < '1';
            }),'integer','min:1','max:100'];
        }
        return $rules;
    }
}
