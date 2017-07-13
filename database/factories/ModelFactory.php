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
//$factory->define(App\User::class, function (Faker\Generator $faker) {
//    static $password;
//
//    return [
//        'name' => $faker->name,
//        'email' => $faker->unique()->safeEmail,
//        'password' => $password ?: $password = bcrypt('secret'),
//        'remember_token' => str_random(10),
//    ];
//});

$factory->define(App\Developer::class, function (Faker\Generator $faker) {
//    static $password;

    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'experience' => $faker->randomDigit,
        'email' => $faker->unique()->safeEmail,
        'skype' => $faker->unique()->userName,
        'git' => $faker->unique()->url,
        'password' => $faker->password
    ];
});

$factory->define(App\Project::class, function (Faker\Generator $faker) {
//    static $password;

    return [
        'name' => $faker->catchPhrase,
        'description' => $faker->text,
        'completed' => $faker->date($format = 'Y-m-d', $max = 'now')
    ];
});

$factory->define(App\Technology::class, function (Faker\Generator $faker) {
//    static $password;

    return [
        'name' => $faker->word
    ];
});