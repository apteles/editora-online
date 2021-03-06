<?php

namespace CodeEduBook\Http\Controllers;

use Illuminate\Http\Request;
use CodeEduBook\Repositories\BookRepository;
use Users\Annotations\Mappings\Action as ActionAnnotation;
use Users\Annotations\Mappings\Controller as ControllerAnnotation;

/**
 * @ControllerAnnotation(name="book-trashed-admin",description="Administração de Lixeira Livros")
 */
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
     * @ActionAnnotation(name="list",description="Ver listagem de Lixeira Livros")
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $books = $this->bookRepository->onlyTrashed()->paginate(10);

        return view('codeedubook::trashed.books.index', \compact('books', 'search'));
    }

    public function show($id)
    {
        $this->bookRepository->onlyTrashed();
        $book = $this->bookRepository->find($id);

        return view('codeedubook::trashed.books.show', \compact('book'));
    }

    /**
     * @ActionAnnotation(name="update",description="Restaura Livros da Lixeira")
    */
    public function update(Request $request, $id)
    {
        $this->bookRepository->onlyTrashed();
        $this->bookRepository->restore($id);
        $request->session()->flash('message', 'Livro restaurado com sucesso.');
        $urlPrevious = $request->get('redirect_to', route('trashed.books.index'));

        return redirect()->to($urlPrevious);
    }
}
