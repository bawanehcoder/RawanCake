<?php

namespace App\Http\Requests\Admin;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Http\FormRequest;

class RoleAndPermissionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
      //  if(Admin()->authorizeCheck('users admin create')){return true;}
        if(Admin()->can('users admin create')){
            return true;
        }
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
   protected function failedAuthorization()
   {
       throw new AuthorizationException(__('admin only an autorization'));
   }

    public function rules(): array
    {
        return [
            'permissions_ids'=>'required',
            'permissions_ids.*'=>['exists:permissions,name'],
//            'role'=>['required','unique:roles,name','max:60']
        ];
    }
}
