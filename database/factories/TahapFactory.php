<?php

use Faker\Generator as Faker;

$factory->define(Tahap::class, function (Faker $faker) {
    return [
        'nama' => 'Tahap 1'
    ];
});
