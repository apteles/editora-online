<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Bootstrapper\Interfaces\TableInterface;

class Book extends Model implements TableInterface
{
    protected $fillable = ['title', 'subtitle', 'price', 'author_id'];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
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
}
