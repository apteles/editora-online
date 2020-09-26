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

    public function __construct(UserRepository $model)
    {
        $this->userRepository = $model;
    }

    public function redirectAfterVerification()
    {
        $this->loginUser();
        return route('codeeduuser.user_settings.edit');
    }

    private function loginUser()
    {
        $email = Request::get('email');
        $user = $this->user->findByField('email', $email)->first();

        Auth::login($user);
    }
}
