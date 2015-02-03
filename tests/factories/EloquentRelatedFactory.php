<?php

/*
|--------------------------------------------------------------------------
| Build Entities
|--------------------------------------------------------------------------
*/

// Options
$colourOption	= Factory::create('OptionColour');
$sizeOption 	= Factory::create('SizeColour');

// Option Values
$colours = new Collection([
	Factory::create('OptionValueColour'),
	Factory::create('OptionValueColour'),
	Factory::create('OptionValueColour'),
]);
$sizes = new Collection([
	Factory::create('OptionValueSize'),
	Factory::create('OptionValueSize'),
	Factory::create('OptionValueSize'),
]);

// Product
$product = Factory::create('Product');


/*
|--------------------------------------------------------------------------
| Create Relations
|--------------------------------------------------------------------------
*/

// OptionValues --> Option
$colourOption->setValues($colours);
$sizeOption->setValues($sizes);

// build options collection
$options = new Collection([$colourOption,$sizeOption]);

// Options --> Product
$product->setOptions($options);
$product->save();