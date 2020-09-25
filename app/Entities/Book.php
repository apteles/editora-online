<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Bootstrapper\Interfaces\TableInterface;
use Collective\Html\Eloquent\FormAccessible;

class Book extends Model implements TableInterface
{
    use FormAccessible;

    protected $fillable = ['title', 'subtitle', 'price', 'author_id'];

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
        return $this->belongsToMany(Category::class);
    }
}
