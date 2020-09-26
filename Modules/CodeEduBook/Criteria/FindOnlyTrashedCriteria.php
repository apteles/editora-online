<?php

namespace CodeEduBook\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class FindOnlyTrashedCriteria.
 *
 * @package namespace App\Criteria;
 */
class FindOnlyTrashedCriteria implements CriteriaInterface
{
    public function apply($model, RepositoryInterface $repository)
    {
        return $model->onlyTrashed();
    }
}
