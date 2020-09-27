<?php

namespace Users\Facade;

use Users\Menu\Navbar;
use Illuminate\Support\Facades\Facade;

class NavbarAuthorization extends Facade
{
    public static function getFacadeAccessor()
    {
        return Navbar::class;
    }
}
