<?php

namespace CodeEduBook\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class FindByBook implements CriteriaInterface
{
    private $bookId;

    public function __construct($bookId)
    {
        $this->bookId = $bookId;
    }

    public function apply($model, RepositoryInterface $repostory)
    {
        return $model->where('book_id', $this->bookId);
    }
}
