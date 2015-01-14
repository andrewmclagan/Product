<?php

$factory('Jiro\Product\EloquentProduct', 'Product', [
    'name'              => $faker->name,
    'slug'              => $faker->name,
    'description'       => $faker->paragraph,
    'available_on'      => $faker->dateTime('yesterday'),
    'meta_keywords'     => $faker->word,
    'meta_description'  => $faker->paragraph
]);
