<?php

$factory('Jiro\Product\Property\EloquentProperty', 'ColourProperty', [
    'name'          => 'Colour',
    'presentation'	=> 'T-Shirt Colour',
    'type'       	=> 'text',
]);

$factory('Jiro\Product\Property\EloquentProperty', 'SizeProperty', [
    'name'          => 'Size',
    'presentation'	=> 'T-Shirt Size',
    'type'       	=> 'text',
]);

$factory('Jiro\Product\Property\EloquentProperty', 'MaterialProperty', [
    'name'          => 'Material',
    'presentation'	=> 'T-Shirt Material',
    'type'       	=> 'text',
]);

$factory('Jiro\Product\Property\EloquentProperty', 'Property', [
    'name'          => $faker->word,
    'presentation'	=> $faker->word,
    'type'       	=> 'text',
]);