<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Permit;
use Faker\Generator as Faker;

$factory->define(Permit::class, function (Faker $faker) {
    return [
        'user_id' => $faker->unique()->numberBetween(1, 20),
        'date_permit' => now(),
        'note' => $faker->text,
        'status' => 1
    ];
});