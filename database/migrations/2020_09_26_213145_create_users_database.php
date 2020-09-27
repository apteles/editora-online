<?php

use Users\Entities\User;
use Illuminate\Database\Migrations\Migration;

class CreateUsersDatabase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        factory(User::class, 1)->create([
            'name' => config('users.user_default.name'),
            'email' => config('users.user_default.email'),
            'password' => bcrypt(config('users.user_default.password')),
            'verified' => true
        ]);
        // User::create([
       //     'name' => config('users.user_default.name'),
       //     'email' => config('users.user_default.email'),
       //     'password' => bcrypt(config('users.user_default.password')),
       //     'verified' => true
       // ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $user = User::where('email', config('users.user_default.email'))->first();

        $user->forceDelete();
    }
}
