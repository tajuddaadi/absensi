<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Permit;
use Faker\Generator as Faker;

$factory->define(Permit::class, function (Faker $faker) {
    return [
        'user_id' => $faker->name,
        '' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
    ];
});