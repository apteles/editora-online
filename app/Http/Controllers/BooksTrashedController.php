<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\BookRepository;

class BooksTrashedController extends Controller
{
    /**
     * Repository Book
     */
    private $bookRepository;

    public function __construct(BookRepository $book)
    {
        $this->bookRepository = $book;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $books = $this->bookRepository->onlyTrashed()->paginate(10);

        return view('trashed.books.index', \compact('books', 'search'));
    }

    public function show($id)
    {
        $this->bookRepository->onlyTrashed();
        $book = $this->bookRepository->find($id);

        return view('trashed.books.show', \compact('book'));
    }

    public function update(Request $request, $id)
    {
        $this->bookRepository->onlyTrashed();
        $this->bookRepository->restore($id);
        $request->session()->flash('message', 'Livro restaurado com sucesso.');
        $urlPrevious = $request->get('redirect_to', route('trashed.books.index'));

        return redirect()->to($urlPrevious);
    }
}
