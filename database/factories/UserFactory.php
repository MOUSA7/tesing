<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => bcrypt('password'), // password
        'remember_token' => Str::random(10),
        'is_admin'=>false
    ];
});

$factory->define(\App\Post::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(30),      // OR $faker->sentence(12)
        'content' => $faker->paragraph(rand(1,2)),  // OR $faker->paragraph(12,true)
        'user_id' => rand(1,5),
        'created_at'=> $faker->dateTimeBetween('-3 months')
    ];
});

$factory->define(\App\Comment::class, function (Faker $faker) {
    return [
        'content' => $faker->paragraph(rand(1,2)),
//        'post_id' => \App\Post::all()->random()->id,
//        'user_id' => rand(1,5),
        'created_at'=> $faker->dateTimeBetween('-3 months')
    ];
});

$factory->state(\App\Post::class,'new-title',function (Faker $faker){
return [
    'title' => 'New title',
];
});
