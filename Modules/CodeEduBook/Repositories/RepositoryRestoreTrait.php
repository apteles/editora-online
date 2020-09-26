<?php

namespace CodeEduBook\Repositories;

trait RepositoryRestoreTrait
{
    public function restore(int $id)
    {
        $this->applyScope();

        $temporarySkipPresenter = $this->skipPresenter;
        $this->skipPresenter(true);

        $model = $this->find($id);

        $this->skipPresenter($temporarySkipPresenter);
        $this->resetModel();

        $deleted = $model->restore();

        return $deleted;
    }
}
