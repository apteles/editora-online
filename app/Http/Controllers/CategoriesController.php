<?php

namespace App\Http\Controllers;

use App\Entities\Category;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use App\Repositories\CategoryRepository;

class CategoriesController extends Controller
{
    private $categoryRepository;

    public function __construct(CategoryRepository $category)
    {
        $this->categoryRepository = $category;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->categoryRepository->paginate();

        return view('categories.index', \compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = $this->categoryRepository->find($id);
        return view('categories.edit', \compact('category'));
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
     * @param  Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $this->categoryRepository->delete($id);

        $request->session()->flash('message', 'Categoria deletada com sucesso.');
        return redirect()->route('categories.index');
    }
}
