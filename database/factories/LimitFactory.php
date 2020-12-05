<?php

use App\Models\Limit;
use Faker\Generator as Faker;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Limit::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    ];
});
