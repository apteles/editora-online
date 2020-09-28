<?php

namespace CodeEduBook\Entities;

use Users\Entities\User;
use Illuminate\Database\Eloquent\Model;
use Bootstrapper\Interfaces\TableInterface;
use Collective\Html\Eloquent\FormAccessible;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model implements TableInterface
{
    use FormAccessible, SoftDeletes;

    protected $fillable = ['title', 'subtitle', 'price', 'author_id', 'dedication', 'description', 'website', 'percent_complete', 'published'];

    protected $dates = ['deleted_at'];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }

    public function formCategoriesAttribute()
    {
        return $this->categories->pluck('id')->toArray();
    }

    public function getTableHeaders()
    {
        return ['ID', 'Titulo', 'Autor', 'Preço'];
    }

    public function getValueForHeader($header)
    {
        if ($header === 'ID') {
            return $this->id;
        }
        if ($header === 'Titulo') {
            return $this->title;
        }
        if ($header === 'Autor') {
            return $this->author->name;
        }
        if ($header === 'Preço') {
            return $this->price;
        }
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class)->withTrashed();
    }
}
