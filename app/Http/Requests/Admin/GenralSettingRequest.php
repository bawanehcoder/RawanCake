<?php

namespace App\Http\Requests\Admin;

use App\Models\Traits\TranslateValidationErrorAttributesTrait;
use Illuminate\Foundation\Http\FormRequest;


class GenralSettingRequest extends FormRequest
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
            'Currency' => "required|exists:currencies,id",
            'whatsApp_number' => "required|regex:/^([0-9\s\\-\+\(\)]*)$/",
//            'new_account_points' => "required|regex:/^([0-9\s\\(\)]*)$/|min:0|max:1000",
//            'invitation_points' => "required|regex:/^([0-9\s\\(\)]*)$/|min:0|max:1000",
//            'relative_points' => "required|regex:/^([0-9\s\\(\)]*)$/|min:0|max:1000",
            'app_version' => "required|regex:/^([0-9\s\.\-\+\(\)]*)$/|between:0,99.99",
            'order_message_ar' => "required|string|min:20|max:250",
            'order_message_en' => "required|string|min:20|max:250",
            'order_completion_message_ar' => "required|string|min:50|max:500",
            'order_completion_message_en' => "required|string|min:50|max:500",
        ];
    }
}
