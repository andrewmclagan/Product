<?php

$factory('Jiro\Product\Option\EloquentOption', 'Option', [
    'name'          => $faker->word,
    'presentation'	=> $faker->word
]);

$factory('Jiro\Product\Option\EloquentOption', 'OptionColour', [
    'name'          => 'Colour',
    'presentation'	=> 'T-Shirt Colour'
]);

$factory('Jiro\Product\Option\EloquentOption', 'OptionSize', [
    'name'          => 'Size',
    'presentation'	=> 'T-Shirt Size'
]);