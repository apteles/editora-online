<?php

namespace App\Criterias;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class FindByTitle implements CriteriaInterface
{
    private $title;

    public function __construct($title)
    {
        $this->title = $title;
    }

    public function apply($model, RepositoryInterface $repostory)
    {
        return $model->where('title', $this->title);
    }
}
