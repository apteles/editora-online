<?php

namespace CodeEduBook\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use CodeEduBook\Criteria\FindByBook;
use CodeEduBook\Criteria\FindByAuthor;
use Illuminate\Support\Facades\Session;
use CodeEduBook\Repositories\BookRepository;
use CodeEduBook\Repositories\ChapterRepository;
use CodeEduBook\Http\Requests\ChapterCreateRequest;
use Users\Annotations\Mappings\Action as ActionAnnotation;
use Users\Annotations\Mappings\Controller as ControllerAnnotation;

/**
 * @ControllerAnnotation(name="chapters-admin",description="Administração de Capítulos")
 */
class ChaptersController extends Controller
{
    private $bookRepository;

    private $chapterRepository;

    public function __construct(BookRepository $book, ChapterRepository $chapter)
    {
        $this->bookRepository = $book;
        $this->bookRepository->pushCriteria(new FindByAuthor);
        $this->chapterRepository = $chapter;
    }

    /**
     * Display a listing of the resource.
     * @ActionAnnotation(name="list",description="Ver listagem de Capítulos")
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id)
    {
        $book = $this->bookRepository->find($id);
        $search = $request->get('search');
        $this->chapterRepository->pushCriteria(new FindByBook($id));
        $chapters = $this->chapterRepository->paginate(10);

        return view('codeedubook::chapters.index', \compact('chapters', 'search', 'book'));
    }

    /**
     * Show the form for creating a new resource.
     * @ActionAnnotation(name="store",description="Criar Capítulos")
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $book = $this->bookRepository->find($id);

        return view('codeedubook::chapters.create', \compact('book'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ChapterCreateRequest $request, $id)
    {
        $book = $this->bookRepository->find($id);

        $dataFromRequest = $request->all();
        $dataFromRequest['book_id'] = $book->id;

        $this->chapterRepository->create($dataFromRequest);

        $request->session()->flash('message', 'Capítulo cadastrado com sucesso.');
        $previousURL = $request->get('redirect_to', route('chapters.index', ['book' => $id]));
        return redirect()->to($previousURL);
    }

    /**
     * Show the form for editing the specified resource.
     * @ActionAnnotation(name="update",description="Atualizar Capítulos")
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($bookId, $id)
    {
        $book = $this->bookRepository->find($bookId);
        $this->chapterRepository->pushCriteria(new FindByBook($book->id));
        $chapter = $this->chapterRepository->find($id);

        return view('codeedubook::chapters.edit', \compact('book', 'chapter'));
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, $bookId, $chapterId)
    {
        $book = $this->bookRepository->find($bookId);
        $this->chapterRepository->pushCriteria(new FindByBook($book->id));
        $dataFromRequest = $request->except('book_id');

        $this->chapterRepository->update($dataFromRequest, $chapterId);

        $request->session()->flash('message', 'Capítulo atualizado com sucesso.');
        $previousURL = $request->get('redirect_to', route('chapters.index', ['book' => $book->id]));
        return redirect()->to($previousURL);
    }

    /**
     * Remove the specified resource from storage.
     * @ActionAnnotation(name="destroy",description="Excluir Livros")
     * @param  Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($bookId, $chapterId)
    {
        $book = $this->bookRepository->find($bookId);
        $this->chapterRepository->pushCriteria(new FindByBook($book->id));
        $this->chapterRepository->delete($chapterId);
        Session::flash('message', 'Capítulo excluído com sucesso.');
        return redirect()->to(URL::previous());
    }
}
