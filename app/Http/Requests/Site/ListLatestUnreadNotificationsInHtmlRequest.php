<?php

namespace App\Http\Requests\Site;
use Illuminate\Foundation\Http\FormRequest;
class ListLatestUnreadNotificationsInHtmlRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'after_date' => 'nullable|date',
            'exclude_ids' => 'nullable|array',
            'exclude_ids.*' => [
                'nullable',
                'uuid',
            ],

        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
