<?php

use App\Models\Disposition;
use Faker\Generator as Faker;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Disposition::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    ];
});
