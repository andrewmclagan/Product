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
	public function it_should_allow_assigning_itself_to_a_product()
	{
		$variation = Factory::create('Variation');
		$product = Factory::create('Product');

		$variation->setProduct($product);
		$this->assertEquals($variation->product, $product);
	}

	/** @test */
    public function it_should_allow_detaching_itself_from_a_product()
    {
 		$variation = Factory::create('Variation');
		$product = Factory::create('Product');

		$variation->setProduct($product);
		$this->assertEquals($variation->product, $product);

		$variation->setProduct(null);
		$this->assertEquals($variation->product, null);		
    }	

    /** @test */
    public function it_should_not_be_master_variant_by_default()
    {
    	$variation = Factory::create('Variation');

    	$this->assertEquals($variation->isMaster(), false);
    }

    /** @test */
    public function it_is_master_variant_when_marked_so()
    {
		$variation = Factory::create('Variation');

		$this->assertEquals($variation->isMaster(), false);
		$variation->setMaster(true);
		$this->assertEquals($variation->isMaster(), true);
    }

    /** @test */
    public function its_presentation_should_be_mutable()
    {
    	$variation = Factory::create('Variation');

    	$variation->setPresentation('Super Variant');

    	$this->assertEquals($variation->getPresentation(), 'Super Variant');    	
    }

	/** @test */
	public function it_has_fluent_interface() 
	{

	}					
}