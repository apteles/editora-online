<?php

namespace Users\Http\Requests;

use Users\Entities\User;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'email' => "required|unique:users,email,{$this->getIdRouteParamOrNull()}|max:255",
            //    'roles.*' => 'exists:roles,id'
        ];
    }

    public function getIdRouteParamOrNull()
    {
        return $this->route('user') ?? 'NULL';
    }
}
