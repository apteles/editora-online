<?php

namespace CodeEduBook\Criteria;

use Illuminate\Support\Facades\Auth;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class FindByAuthor implements CriteriaInterface
{
    public function apply($model, RepositoryInterface $repostory)
    {
        if (!Auth::user()->can(config('codeeduuser.acl.permissions.book_manage_all'))) {
            return $model->where('author_id', Auth::user()->id);
        }
        return $model;
    }
}
