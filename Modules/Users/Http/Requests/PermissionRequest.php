<?php

namespace Users\Http\Requests;

use Users\Entities\Permission;
use Illuminate\Foundation\Http\FormRequest;

class PermissionRequest extends FormRequest
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
        $id = null;
        $role = null;

        if ($role = $this->route('role') instanceof Permission) {
            $id = $role->id;
        }

        if ($role = $this->route('role')) {
            $id = $role;
        }

        return [
            //      'permissions' => "required|array",
            'permissions.*' => "exists:permissions,$id"
        ];
    }
}
