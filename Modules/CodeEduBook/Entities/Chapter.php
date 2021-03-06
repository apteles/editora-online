<?php

namespace CodeEduBook\Entities;

use Illuminate\Database\Eloquent\Model;
use Bootstrapper\Interfaces\TableInterface;

class Chapter extends Model implements TableInterface
{
    protected $fillable = ['name', 'content', 'order', 'book_id'];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function getTableHeaders()
    {
        return ['#', 'Nome', 'Order'];
    }

    public function getValueForHeader($header)
    {
        if ($header === '#') {
            return $this->id;
        }
        if ($header === 'Nome') {
            return $this->name;
        }
        if ($header === 'Order') {
            return $this->order;
        }
    }
}
