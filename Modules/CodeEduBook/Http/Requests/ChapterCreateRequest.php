<?php

namespace CodeEduBook\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChapterCreateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'content' => 'required',
            'order' => 'required|integer'
        ];
    }
}
