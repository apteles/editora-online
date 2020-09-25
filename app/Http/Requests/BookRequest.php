<?php

namespace App\Http\Requests;

use App\Repositories\BookRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
{
    private $bookRepository;

    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $id = (int) $this->route('book');

        if ($id === 0) {
            return false;
        }

        $book = $this->bookRepository->find($id);

        return $book->author_id === Auth::user()->id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => "required|unique:books,title,{$this->getIdRouteParamOrNull()}|max:255",
            'subtitle' => 'required|max:255',
            'price' => 'required|max:255',
        ];
    }

    public function getIdRouteParamOrNull()
    {
        return $this->route('book') ?? 'NULL';
    }
}
