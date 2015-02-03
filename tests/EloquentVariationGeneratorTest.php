<?php namespace Jiro\Product\Tests;

use Illuminate\Database\Eloquent\Collection;
use Laracasts\TestDummy\Factory;

class EloquentVariationGeneratorTest extends TestCase {

	/** @test **/					
    public function it_should_generate_all_possible_variations()
    {
        // Build
        $product       = Factory::create('Product');
        $colourOption  = Factory::create('OptionColour');
        $colourValues  = Collection([
            Factory::create('OptionValueColour'),
            Factory::create('OptionValueColour'),
            Factory::create('OptionValueColour'),
        ]);
        $sizeOption    = Factory::create('OptionSize');
        $sizeValues  = Collection([
            Factory::create('OptionValueSize'),
            Factory::create('OptionValueSize'),
            Factory::create('OptionValueSize'),
        ]);

        // relate
        $colourOption->setValues($colourValues);
        $sizeOption->setValues($sizeValues);
        $product->setOptions();
    }
}