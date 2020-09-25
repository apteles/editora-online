<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['title', 'subtitle', 'price'];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }
}
