<?php

namespace App\Macros;

class Form
{
    public static function register()
    {
        \Form::macro('error', function ($field, $errors) {
            if ($errors->has($field)) {
                return view('errors.error_field', \compact('field'));
            }
            return null;
        });
    }
}
