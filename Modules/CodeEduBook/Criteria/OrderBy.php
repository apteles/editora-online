<?php

namespace CodeEduBook\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class OrderBy implements CriteriaInterface
{
    public function apply($model, RepositoryInterface $repostory)
    {
        return $model->orderBy('order', 'asc');
    }
}
