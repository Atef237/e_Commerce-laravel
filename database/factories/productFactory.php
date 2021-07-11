<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(product::class, function (Faker $faker) {
    return [

        'name'         => $faker->text(60),
        'description'  => $faker->paragraph(),
        'price'        =>$faker->numberBetween(100,10000),
        'manage_stock' =>false,
        'in_stock'     =>$faker->boolean(),
        'slug'         => $faker->slug(),
        'is_active'    => $faker->boolean(),

    ];
});
