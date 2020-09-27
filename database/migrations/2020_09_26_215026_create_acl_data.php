<?php

use Users\Entities\Role;
use Users\Entities\User;
use Illuminate\Database\Migrations\Migration;

class CreateAclData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $role = Role::create([
            'name' => config('users.acl.role_admin'),
            'description' => 'Administrador capaz de efetuar qualquer ação no sistema'
        ]);

        $user = $this->getUser();
        $user->roles()->save($role);
    }

    public function down()
    {
        $roleAdmin = Role::where('name', config('users.acl.role_admin'))->first();
        $user = User::where('email', config('users.user_default.email'))->first();
        $user->roles()->detach($roleAdmin->id);

        $roleAdmin->permissions()->detach();
        $roleAdmin->users()->detach();
        $roleAdmin->delete();
    }

    private function getUser()
    {
        return User::where('email', config('users.user_default.email'))->first();
    }
}
