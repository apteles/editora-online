<?php

namespace CodeEduBook\Repositories;

use CodeEduBook\Entities\Category;
use CodeEduBook\Criteria\OnlyTrashedTrait;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class CategorysRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class CategoryRepositoryEloquent extends BaseRepository implements CategoryRepository
{
    use BaseRepositoryTrait, OnlyTrashedTrait;

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Category::class;
    }

    public function listsWithMutators($column, $key = null)
    {
        $collection = $this->all();
        return $collection->pluck($column, $key);
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
