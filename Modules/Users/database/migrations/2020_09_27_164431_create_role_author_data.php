<?php

use Users\Entities\Role;
use Illuminate\Database\Migrations\Migration;

class CreateRoleAuthorData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Role::create([
            'name' => config('codeedubook.acl.role_author'),
            'description' => 'Autor de Livros no sistema'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $roleAuthor = Role::where('name', config('codeedubook.acl.role_author'));
        $roleAuthor->permissions()->detach();
        $roleAuthor->users()->detach();
        $roleAuthor->delete();
    }
}
