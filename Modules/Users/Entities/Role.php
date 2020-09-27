<?php

namespace Users\Entities;

use Illuminate\Database\Eloquent\Model;
use Bootstrapper\Interfaces\TableInterface;

class Role extends Model implements TableInterface
{
    protected $fillable = ['name', 'description'];

    public function getTableHeaders()
    {
        return ['Nome', 'Descrição'];
    }

    public function getValueForHeader($header)
    {
        if ($header === 'Nome') {
            return $this->name;
        }
        if ($header === 'Descrição') {
            return $this->description;
        }
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
