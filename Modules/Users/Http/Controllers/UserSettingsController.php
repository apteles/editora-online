<?php

namespace Users\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Users\Repositories\UserRepository;
use Users\Http\Requests\UserSettingsRequest;

class UserSettingsController extends Controller
{
    private $user;

    public function __construct(UserRepository $model)
    {
        $this->user = $model;
    }

    /**
    *
    * @return void
    */
    public function edit()
    {
        $user = Auth::user();

        return view('users::users-settings.settings', \compact('user'));
    }

    /**
    *
    * @return void
    */
    public function update(UserSettingsRequest $request)
    {
        $user = Auth::user();

        $this->user->update($request->all(), $user->id);
        $request->session()->flash('message', 'Usuário atualizado com sucesso.');
        return redirect()->to(route('user_settings.edit'));
    }
}
