<?php

use Users\Entities\Role;
use Users\Entities\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $author = factory(User::class, 1)->states('author')->create();
        $roleAuthor = Role::where('name', config('codeedubook.acl.role_author'))->first();
        $author->roles()->attach($roleAuthor->id);
    }
}
