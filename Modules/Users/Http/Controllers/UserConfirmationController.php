<?php

namespace Users\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Users\Repositories\UserRepository;
use Jrean\UserVerification\Traits\VerifiesUsers;

class UserConfirmationController extends Controller
{
    use VerifiesUsers;

    private $userRepository;

    private $request;

    public function __construct(UserRepository $model, Request $request)
    {
        $this->userRepository = $model;
        $this->request = $request;
    }

    public function redirectAfterVerification()
    {
        $this->loginUser();
        return route('user_settings.edit');
    }

    private function loginUser()
    {
        $email = $this->request->get('email');
        $user = $this->userRepository->findByField('email', $email)->first();

        Auth::login($user);
    }
}
