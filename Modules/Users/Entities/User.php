<?php

namespace Users\Entities;

use Illuminate\Notifications\Notifiable;
use Bootstrapper\Interfaces\TableInterface;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements TableInterface
{
    use Notifiable,SoftDeletes;

    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function generatePassword($password = null)
    {
        return $password ? bcrypt($password) : bcrypt(str_random(8));
    }

    public function getTableHeaders()
    {
        return ['ID', 'Nome', 'Email', 'Roles'];
    }

    public function getValueForHeader($header)
    {
        if ($header === 'ID') {
            return $this->id;
        }
        if ($header === 'Nome') {
            return $this->name;
        }
        if ($header === 'Email') {
            return $this->email;
        }
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}
