<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Bootstrapper\Interfaces\TableInterface;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Category extends Model implements TableInterface, Transformable
{
    use TransformableTrait;
    protected $fillable = ['name'];

    public function getTableHeaders()
    {
        return ['ID', 'Nome'];
    }

    public function getValueForHeader($header)
    {
        if ($header === 'ID') {
            return $this->id;
        }
        if ($header === 'Nome') {
            return $this->name;
        }
    }
}
