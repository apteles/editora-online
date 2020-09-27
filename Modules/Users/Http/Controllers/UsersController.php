<?php

namespace Users\Http\Controllers;

use Users\Http\Requests\UserRequest;
use Users\Repositories\RoleRepository;
use Users\Repositories\UserRepository;
use Users\Http\Requests\UserDeleteRequest;
use Users\Annotations\Mappings\Action as ActionAnnotation;
use Users\Annotations\Mappings\Controller as ControllerAnnotation;

/**
 * @ControllerAnnotation(name="users-admin",description="Administração de usuário")
 */
class UsersController extends Controller
{
    private $userRepository;

    private $roleRepository;

    public function __construct(UserRepository $user, RoleRepository $role)
    {
        $this->userRepository = $user;
        $this->roleRepository = $role;
    }

    /**
     * @ActionAnnotation(name="list",description="Listar Usuários")
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
     * @ActionAnnotation(name="create",description="Criar Usuário")
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = $this->roleRepository->alll()->pluck('name', 'id');
        return view('users::users.create', \compact('roles'));
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
     * @ActionAnnotation(name="update",description="Editar Usuário")
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->userRepository->find($id);
        $roles = $this->roleRepository->all()->pluck('name', 'id');
        return view('users::users.edit', \compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     * @ActionAnnotation(name="update",description="Editar Usuário")
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $data = $request->except(['password']);
        $this->userRepository->update($data, $id);

        $request->session()->flash('message', 'Usuário atualizado com sucesso.');
        $previousURL = $request->get('redirect_to', route('users.index'));
        return redirect()->to($previousURL);
    }

    /**
     * Remove the specified resource from storage.
     * @ActionAnnotation(name="destroy",description="Remover Usuário")
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserDeleteRequest $request, $id)
    {
        $this->userRepository->delete($id);

        $request->session()->flash('message', 'Usuário deletado com sucesso.');
        return redirect()->route('users.index');
    }
}
