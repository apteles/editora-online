<?php

namespace Users\Annotations\Mappings;

/**
 * @Annotation
 * @Target("METHOD")
 */
class Action
{
    public $name;
    public $description;
}
