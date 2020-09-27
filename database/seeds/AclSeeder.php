<?php

use Users\Entities\Role;
use Users\Entities\Permission;
use Illuminate\Database\Seeder;

class AclSeeder extends Seeder
{
    public function run()
    {
        $roleAuthor = Role::where('name', config('codeedubook.acl.role_author'))->first();
        $permissionBook = Permission::where('name', 'like', 'book%')->pluck('id')->all();
        $permissionCategory = Permission::where('name', 'like', 'category%')->pluck('id')->all();

        $roleAuthor->permissions()->attach($permissionBook);
        $roleAuthor->permissions()->attach($permissionCategory);
    }
}
