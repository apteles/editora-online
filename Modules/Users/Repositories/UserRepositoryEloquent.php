<?php

namespace Users\Repositories;

use Users\Entities\User;
use CodeEduBook\Criteria\OnlyTrashedTrait;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Jrean\UserVerification\Facades\UserVerification;

/**
 * Class CategorysRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    use OnlyTrashedTrait;

    public function create(array $attributes)
    {
        $attributes['password'] = User::generatePassword();

        $model = parent::create($attributes);
        UserVerification::generate($model);
        $subject = config('users.email.user_created.subject');
        UserVerification::emailView('users::emails.user-created');
        UserVerification::send($model, $subject);
        return $model;
    }

    public function update(array $attributes, $id)
    {
        if (isset($attributes['password'])) {
            $attributes['password'] = User::generatePassword($attributes['password']);
        }
        return parent::update($attributes, $id);

        // code...
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
