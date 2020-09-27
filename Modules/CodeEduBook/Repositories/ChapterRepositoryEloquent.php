<?php

namespace CodeEduBook\Repositories;

use CodeEduBook\Entities\Chapter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class BooksRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ChapterRepositoryEloquent extends BaseRepository implements ChapterRepository
{
    protected $fieldSearchable = [
        'title' => 'like',
        'author.name' => 'like',
        'categories.name' => 'like'
    ];

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Chapter::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
