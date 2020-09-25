<?php

namespace App\Http\Controllers;

use App\Entities\Book;
use Illuminate\Http\Request;
use App\Http\Requests\BookRequest;
use App\Repositories\BookRepository;
use Illuminate\Support\Facades\Auth;

class BooksController extends Controller
{
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
        $books = $this->bookRepository->paginate();

        return view('books.index', \compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookRequest $request)
    {
        $dataFromRequest = $request->all();
        $dataFromRequest['author_id'] = Auth::user()->id;
        $this->bookRepository->create($dataFromRequest);

        $request->session()->flash('message', 'Livro cadastrado com sucesso.');
        $previousURL = $request->get('redirect_to', route('books.index'));
        return redirect()->to($previousURL);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        return view('books.edit', \compact('book'));
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(BookRequest $request, $id)
    {
        $dataFromRequest = $request->except('author_id');

        $this->bookRepository->update($dataFromRequest, $id);

        $request->session()->flash('message', 'Livro cadastrado com sucesso.');
        $previousURL = $request->get('redirect_to', route('books.index'));
        return redirect()->to($previousURL);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->bookRepository->delete($id);
        return redirect()->route('books.index');
    }
}
