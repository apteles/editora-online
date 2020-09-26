<?php

namespace CodeEduBook\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Foundation\Http\FormRequest;
use CodeEduBook\Repositories\BookRepository;

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
        if (!$this->isCreatingRecord()) {
            $id = (int) $this->route('book');

            if ($id === 0) {
                return false;
            }

            $book = $this->bookRepository->find($id);

            return $book->author_id === Auth::user()->id;
        }

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
            'title' => "required|unique:books,title,{$this->getIdRouteParamOrNull()}|max:255",
            'subtitle' => 'required|max:255',
            'price' => 'required|max:255',
            'categories.*' => 'exists:categories,id',
            'categories' => 'required:array'
        ];
    }

    public function getIdRouteParamOrNull()
    {
        return $this->route('book') ?? 'NULL';
    }

    private function isCreatingRecord()
    {
        return $this->method() === 'POST';
    }

    public function messages()
    {
        $result = [];

        $categories = $this->get('categories', []);
        $count = \count($categories);

        if (\is_array($categories) && $count > 0) {
            foreach (\range(0, $count - 1) as $value) {
                $field = Lang::get('validation.attributes.categories_*', ['num' => $value + 1]);
            }
            $message = Lang::get('validation.exists', ['attributes' => $field]);

            $result["categories.$value.exists"] = $message;
        }

        return $result;
    }
}
