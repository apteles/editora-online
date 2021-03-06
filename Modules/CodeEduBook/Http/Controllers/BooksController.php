<?php

namespace CodeEduBook\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use CodeEduBook\Criteria\FindByAuthor;
use CodeEduBook\Http\Requests\BookRequest;
use CodeEduBook\Repositories\BookRepository;
use CodeEduBook\Repositories\CategoryRepository;
use Users\Annotations\Mappings\Action as ActionAnnotation;
use Users\Annotations\Mappings\Controller as ControllerAnnotation;

/**
 * @ControllerAnnotation(name="book-admin",description="Administração de Livros")
 */
class BooksController extends Controller
{
    private $bookRepository;

    private $categoryRepository;

    public function __construct(BookRepository $book, CategoryRepository $category)
    {
        $this->bookRepository = $book;
        $this->bookRepository->pushCriteria(new FindByAuthor);
        $this->categoryRepository = $category;
    }

    /**
     * Display a listing of the resource.
     * @ActionAnnotation(name="list",description="Ver listagem de Livros")
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $books = $this->bookRepository->paginate();
        return view('codeedubook::books.index', \compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     * @ActionAnnotation(name="store",description="Criar Livros")
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->categoryRepository->lists('name', 'id');

        return view('codeedubook::books.create', \compact('categories'));
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
        $dataFromRequest['published'] = $request->get('published', false);
        $this->bookRepository->create($dataFromRequest);

        $request->session()->flash('message', 'Livro cadastrado com sucesso.');
        $previousURL = $request->get('redirect_to', route('books.index'));
        return redirect()->to($previousURL);
    }

    /**
     * Show the form for editing the specified resource.
     * @ActionAnnotation(name="update",description="Atualizar Livros")
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = $this->bookRepository->find($id);
        $this->categoryRepository->withTrashed();

        $categories = $this->categoryRepository->listsWithMutators('name_trashed', 'id');
        return view('codeedubook::books.edit', \compact('book', 'categories'));
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
     * @ActionAnnotation(name="destroy",description="Excluir Livros")
     * @param  Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->bookRepository->delete($id);
        return redirect()->route('codeedubook::books.index');
    }
}
