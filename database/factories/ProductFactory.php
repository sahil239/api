<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        //

        'name' => $faker-> word,
        'description' => $faker-> sentence,
        'price' => $faker->numberBetween(1500,3500),
        'stock' => $faker->numberBetween(10, 75),
        'discount' => $faker->numberBetween(5,20)
    ];
});
