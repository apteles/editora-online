<?php

namespace Users\Facade;

use Illuminate\Support\Facades\Facade;
use Users\Annotations\Readers\Permission as Reader;

class PermissionReader extends Facade
{
    public static function getFacadeAccessor()
    {
        return Reader::class;
    }
}
