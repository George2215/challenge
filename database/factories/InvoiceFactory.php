<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Invoice;
use Faker\Generator as Faker;

$factory->define(Invoice::class, function (Faker $faker) {
    return [
        'date' => $faker->dateTimeBetween('-30 days', '+30 days'),
        'type' => $faker->randomElement(['Contado', 'Credito']),
    ];
});
