<?php

namespace CodeEduBook\Repositories;

use CodeEduBook\Criteria\OnlyTrashedInterface;
use Prettus\Repository\Contracts\RepositoryInterface;
use Prettus\Repository\Contracts\RepositoryCriteriaInterface;

/**
 * Interface BooksRepository.
 *
 * @package namespace App\Repositories;
 */
interface BookRepository extends RepositoryInterface, RepositoryCriteriaInterface, OnlyTrashedInterface, RepositoryRestoreInterface
{
    //
}
