<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Bootstrapper\Interfaces\TableInterface;

class Category extends Model implements TableInterface
{
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
