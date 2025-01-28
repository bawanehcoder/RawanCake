<?php

namespace App\Http\Requests\Admin;

use App\Models\Traits\TranslateValidationErrorAttributesTrait;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class ConditionalDeliverieRequest extends FormRequest
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
            'products'=>"nullable|array|min:1",
            'zones'=>"nullable|array|min:1",
            'title_ar'=>"required|string|min:1|max:255",
            'title_en'=>"required|string|min:1|max:255",
            'purchase_value'=>['nullable',Rule::requiredIf(function () {
                return $this->input('purchase_value') < '1';
            }),'numeric','between:0.0,99.99'],
            'delivery'=>['nullable',Rule::requiredIf(function () {
                return $this->input('delivery') < '1';
            }),'numeric','between:0.0,99.99'],
            'start_time' => 'required|date|after:'.Carbon::parse(now())->hour(-1),
            'end_time' => 'date|after:start_time',

        ];
    }
}
