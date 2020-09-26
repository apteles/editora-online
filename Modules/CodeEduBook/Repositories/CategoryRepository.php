<?php

namespace CodeEduBook\Repositories;

use CodeEduBook\Criteria\OnlyTrashedInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface CategorysRepository.
 *
 * @package namespace App\Repositories;
 */
interface CategoryRepository extends RepositoryInterface, OnlyTrashedInterface
{
    public function listsWithMutators($column, $key = null);
}
