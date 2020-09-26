<?php

namespace App\Repositories;

use App\Criteria\OnlyTrashedInterface;
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
