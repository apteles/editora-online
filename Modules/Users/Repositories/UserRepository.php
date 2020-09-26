<?php

namespace Users\Repositories;

use CodeEduBook\Criteria\OnlyTrashedInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface CategorysRepository.
 *
 * @package namespace App\Repositories;
 */
interface UserRepository extends RepositoryInterface, OnlyTrashedInterface
{
}
