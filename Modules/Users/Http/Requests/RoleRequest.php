<?php

namespace Users\Http\Requests;

use Users\Repositories\RoleRepository;
use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
{
    private $repository;

    public function __construct(RoleRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $role = $this->repository->findByField('name', config('users.acl.role_admin'))->first();

        return $this->route('role') != $role->id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->route('role');

        if (!$id) {
            $id = 'NULL';
        }

        return [
            'name' => "required|max:255|unique:roles,name,$id",
            'description' => 'max:255',
            'roles.*' => 'exists:roles,id'
        ];
    }
}
