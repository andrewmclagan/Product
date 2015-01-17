<?php

/** 
 * Colour Values
 */
$factory('Jiro\Product\Property\EloquentPropertyValue', 'PropertyValue', [
    'value'          => $faker->word
]);

$factory('Jiro\Product\Property\EloquentPropertyValue', 'ColourPropertyValue', [
    'value'          => $faker->colorName
]);

