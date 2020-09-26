<?php

namespace App\Criteria;

trait OnlyTrashedTrait
{
    public function onlyTrashed()
    {
        $this->pushCriteria(FindOnlyTrashedCriteria::class);

        return $this;
    }
}
