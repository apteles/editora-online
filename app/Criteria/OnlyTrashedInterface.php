<?php

namespace App\Criteria;

interface OnlyTrashedInterface
{
    public function onlyTrashed();

    public function withTrashed();
}
