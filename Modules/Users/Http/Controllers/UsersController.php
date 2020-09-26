<?php

namespace Users\Http\Controllers;

use Illuminate\Http\Request;
use Users\Http\Requests\UserRequest;
use Users\Repositories\UserRepository;

class UsersController extends Controller
{
    private $userRepository;

    public function __construct(UserRepository $user)
    {
        $this->userRepository = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->userRepository->paginate();
        return view('users::users.index', \compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users::users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $this->userRepository->create($request->all());

        $request->session()->flash('message', 'Usuário cadastrado com sucesso.');
        $previousURL = $request->get('redirect_to', route('users.index'));
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
        $user = $this->userRepository->find($id);
        return view('users::users.edit', \compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $this->userRepository->update($request->all(), $id);

        $request->session()->flash('message', 'Usuário atualizado com sucesso.');
        $previousURL = $request->get('redirect_to', route('users.index'));
        return redirect()->to($previousURL);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $this->userRepository->delete($id);

        $request->session()->flash('message', 'Usuário deletado com sucesso.');
        return redirect()->route('users::users.index');
    }
}
