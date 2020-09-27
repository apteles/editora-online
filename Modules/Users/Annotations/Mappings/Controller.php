<?php

namespace Users\Annotations\Mappings;

/**
 * @Annotation
 * @Target("CLASS")
 */
class Controller
{
    public $name;

    public $description;
}
