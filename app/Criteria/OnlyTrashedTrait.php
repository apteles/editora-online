<?php

namespace App\Criteria;

trait OnlyTrashedTrait
{
    public function onlyTrashed()
    {
        $this->pushCriteria(FindOnlyTrashedCriteria::class);

        return $this;
    }

    public function withTrashed()
    {
        $this->pushCriteria(FindWithTrashedCriteria::class);

        return $this;
    }
}
