<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
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
            'title' => "required|unique:books,title,{$this->getIdFromModelIfExist()}|max:255",
            'subtitle' => 'required|max:255',
            'price' => 'required|max:255',
        ];
    }

    public function getIdFromModelIfExist()
    {
        $book = $this->route('book');

        return $book->id ?? 'null';
    }
}
