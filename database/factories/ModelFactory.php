<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use CodeEduBook\Entities\Chapter;

$factory->define(Users\Entities\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'verified' => true
    ];
});

$factory->state(Users\Entities\User::class, 'author', function ($faker) {
    return [
        'email' => 'autor@editora.com'
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(CodeEduBook\Entities\Category::class, function (Faker\Generator $faker) {
    return [
        'name' => \ucfirst($faker->unique()->word()),
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(CodeEduBook\Entities\Book::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->name,
        'subtitle' => $faker->sentence(),
        'price' => $faker->randomFloat(2, 0, 999),
        'author_id' => \rand(1, 2),
        'dedication' => $faker->sentence,
        'description' => $faker->paragraph,
        'website' => $faker->url,
        'percent_complete' => \rand(1, 100)
    ];
});

$factory->define(Chapter::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->sentence(2),
        'content' => $faker->paragraph(10)
    ];
});
