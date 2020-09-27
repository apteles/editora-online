<?php

namespace CodeEduBook\Http\Controllers;

use Illuminate\Http\Request;
use CodeEduBook\Entities\Category;
use CodeEduBook\Http\Requests\CategoryRequest;
use CodeEduBook\Repositories\CategoryRepository;
use Users\Annotations\Mappings\Action as ActionAnnotation;
use Users\Annotations\Mappings\Controller as ControllerAnnotation;

/**
 * @ControllerAnnotation(name="categories-admin",description="Administração de Categorias")
 */
class CategoriesController extends Controller
{
    private $categoryRepository;

    public function __construct(CategoryRepository $category)
    {
        $this->categoryRepository = $category;
    }

    /**
     * Display a listing of the resource.
     * @ActionAnnotation(name="list",description="Ver listagem de Categorias")
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->categoryRepository->paginate();
        return view('codeedubook::categories.index', \compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     * @ActionAnnotation(name="create",description="Criar Categorias")
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('codeedubook::categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $this->categoryRepository->create($request->all());

        $request->session()->flash('message', 'Categoria cadastrada com sucesso.');
        $previousURL = $request->get('redirect_to', route('categories.index'));
        return redirect()->to($previousURL);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @ActionAnnotation(name="update",description="Atualizar Categorias")
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = $this->categoryRepository->find($id);
        return view('codeedubook::categories.edit', \compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        $this->categoryRepository->update($request->all(), $id);

        $request->session()->flash('message', 'Categoria atualizada com sucesso.');
        $previousURL = $request->get('redirect_to', route('categories.index'));
        return redirect()->to($previousURL);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @ActionAnnotation(name="delete",description="Deletar Categorias")
     * @param  Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $this->categoryRepository->delete($id);

        $request->session()->flash('message', 'Categoria deletada com sucesso.');
        return redirect()->route('codeedubook::categories.index');
    }
}
