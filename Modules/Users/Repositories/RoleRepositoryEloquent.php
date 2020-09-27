<?php

namespace Users\Repositories;

use Users\Entities\Role;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class RoleRepositoryEloquent.
 *
 * @package namespace Users\Repositories;
 */
class RoleRepositoryEloquent extends BaseRepository implements RoleRepository
{
    public function update(array $attributes, $id)
    {
        $model = parent::update($attributes, $id);

        if (isset($attributes['permissions'])) {
            $model->permissions()->sync($attributes['permissions']);
        } else {
            $model->permissions()->sync([]);
        }

        return $model;
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Role::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
