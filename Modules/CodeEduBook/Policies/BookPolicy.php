<?php

namespace CodeEduBook\Policies;

use Users\Entities\User;
use CodeEduBook\Entities\Book;
use Illuminate\Auth\Access\HandlesAuthorization;

class BookPolicy
{
    use HandlesAuthorization;

    public function before($user)
    {
        if ($user->can(config('codeedubook.al.permissions.book_manage_all'))) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the book.
     *
     * @param  \Users\Entities\User  $user
     * @param  \CodeEduBook\Entities\Book  $book
     * @return mixed
     */
    public function view(User $user, Book $book)
    {
        //
    }

    /**
     * Determine whether the user can create books.
     *
     * @param  \Users\Entities\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the book.
     *
     * @param  \Users\Entities\User  $user
     * @param  \CodeEduBook\Entities\Book  $book
     * @return mixed
     */
    public function update(User $user, Book $book)
    {
        return $user->id === $book->author_id;
    }

    /**
     * Determine whether the user can delete the book.
     *
     * @param  \Users\Entities\User  $user
     * @param  \CodeEduBook\Entities\Book  $book
     * @return mixed
     */
    public function delete(User $user, Book $book)
    {
        //
    }
}
