<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'name' => "required|max:255|unique:categories,name,{$this->getIdRouteParamOrNull()}"
        ];
    }

    public function getIdRouteParamOrNull()
    {
        return $this->route('category') ?? 'NULL';
    }

    public function messages()
    {
        return [
            'required' => 'O :attribute é obrigatório',
            'unique' => 'O :attribute já está em uso'
        ];
    }

    public function attributes()
    {
        return ['name' => 'nome'];
    }
}
