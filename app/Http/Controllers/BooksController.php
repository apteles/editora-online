<?php

namespace App\Http\Controllers;

use App\Book;
use App\Http\Requests\BookRequest;
use Illuminate\Support\Facades\Auth;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::query()->paginate();

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
        $dataFromRequest['author_id'] = 1;
        //Auth::user()->id;

        Book::create($dataFromRequest);

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
    public function update(BookRequest $request, Book $book)
    {
        $dataFromRequest = $request->except('author_id');

        $book->fill($dataFromRequest);
        $book->save();

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
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('books.index');
    }
}
