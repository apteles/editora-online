<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Bootstrapper\Interfaces\TableInterface;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Category extends Model implements TableInterface, Transformable
{
    use TransformableTrait, SoftDeletes;

    protected $fillable = ['name'];

    protected $dates = ['deleted_at'];

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

    public function books()
    {
        return $this->belongsToMany(Book::class);
    }
}
