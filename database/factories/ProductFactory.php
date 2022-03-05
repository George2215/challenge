<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name'      => $faker->word,
        'quantity'  => $faker->randomElement([100, 150, 90, 55, 220]),
        'price'     => $faker->randomElement(([100, 150, 90, 80, 2000, 1000000, 1500000, 3500000]))
    ];
});
