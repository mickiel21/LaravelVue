<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\ClientInterest;
use Faker\Generator as Faker;

$factory->define(ClientInterest::class, function (Faker $faker ) {
    return [
         'user_id' => 2,
         'interest_id' => $faker->unique()->numberBetween($min = 1, $max = 10),
    ];
});
