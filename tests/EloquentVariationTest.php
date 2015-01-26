<?php namespace Jiro\Product\Tests;

use Laracasts\TestDummy\Factory;

class EloquentVariationTest extends DbTestCase {

	/** @test */
	public function it_should_not_belong_to_a_product_by_default()
	{
		$variation = Factory::create('Variation');

		$this->assertEquals($variation->product, null);
	}

	/** @test */
	public function it_has_fluent_interface() 
	{

	}					
}