<?php

namespace App\Macros;

class Html
{
    private static $self = __CLASS__;

    public static function register()
    {
        self::open();
        self::close();
    }

    private static function open()
    {
        $self = __CLASS__;

        \Html::macro('openFormGroup', function ($field = null, $errors = null) use ($self) {
            return '<div class="form-group ' . $self::hasAnyError($field, $errors) . '">';
        });
    }

    public static function hasAnyError($field, $errors)
    {
        $result = false;

        if ($field !== null && $errors !== null) {
            if (\is_array($field)) {
                foreach ($field as $value) {
                    if (!str_contains($value, '.*') && $errors->has($value) || \count($errors->get($value)) > 0) {
                        $result = true;
                        break;
                    }
                }
            } else {
                if (!str_contains($field, '.*') && $errors->has($field)
                || \count($errors->get($field)) > 0) {
                    $result = true;
                }
            }
        }

        return $result ? 'has-error' : '';
        return ($field != null && $errors != null && $errors->has($field)) ? 'has-error' : '';
    }

    private static function close()
    {
        \Html::macro('closeFormGroup', function () { return '</div>'; });
    }
}
