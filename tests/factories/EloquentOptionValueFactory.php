<?php

$factory('Jiro\Product\Option\EloquentOptionValue', 'OptionValue', [
    'value' => $faker->colorName
]);

$factory('Jiro\Product\Option\EloquentOptionValue', 'OptionValueColour', [
    'value' => $faker->colorName
]);

$factory('Jiro\Product\Option\EloquentOptionValue', 'OptionValueSize', [
    'value' => array_rand(['small','medium','large'])
]);