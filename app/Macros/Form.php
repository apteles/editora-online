<?php

namespace App\Macros;

class Form
{
    public static function register()
    {
        \Form::macro('error', function ($field, $errors) {
            if (!str_contains($field, '.*') && $errors->has($field) || \count($errors->get($field)) > 0) {
                return view('errors.error_field', \compact('field'));
            }
            return null;
        });
    }
}
