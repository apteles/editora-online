<?php

namespace App\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class FindWithTrashedCriteria.
 *
 * @package namespace App\Criteria;
 */
class FindWithTrashedCriteria implements CriteriaInterface
{
    public function apply($model, RepositoryInterface $repository)
    {
        return $model->withTrashed();
    }
}
