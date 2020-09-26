<?php

namespace CodeEduBook\Criteria;

interface OnlyTrashedInterface
{
    public function onlyTrashed();

    public function withTrashed();
}
