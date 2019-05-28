<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Book;
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

// Fill Users Table
$factory->define(User::class, function (Faker $faker) {
	return [
        'username' 		=> 'atma_user'.$faker->unique()->randomElement([1,2,3,4,5]),
        'password' 		=> bcrypt('qwerty123'),
        'fullname'		=> $faker->name,
        'created_at'	=> now(),
        'active'		=> $faker->randomElement(['1' ,'0']),
    ];
});

// Fill Books Table
$factory->define(Book::class, function (Faker $faker) {
	return [
        'title' 		=> $faker->word,
        'desc' 			=> $faker->text,
        'created_by'	=> $faker->randomElement([1,2,3,4,5]),
        'active'		=> $faker->randomElement(['1' ,'0']),
        'created_at'	=> now(),
    ];
});
