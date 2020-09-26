<?php

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
        factory(User::class, 1)->create([
            'email' => 'admin@domain.com',
            'verified' => true
        ]);
        factory(User::class, 9)->create();
    }
}
