<?php namespace Jiro\Product\Tests;

use Jiro\Product\Eloquent\Product;
use Jiro\Property\Eloquent\Property;
use Laracasts\TestDummy\Factory;

class EloquentProductTest extends DbTestCase {

	/** @test */
	public function test_name_attribute_is_mutable()
	{
		$product = new Product;
		$product->setName('Super Product');

		$this->assertEquals('Super Product', $product->getName());
	}

	/** @test */
	public function test_slug_attribute_is_mutable()
	{
		$product = new Product;
		$product->setSlug('Super-Product');

		$this->assertEquals('Super-Product', $product->getSlug());
	}	

	public function test_description_attribute_is_mutable()
	{
		$product = new Product;
		$product->setDescription('Product description');

		$this->assertEquals('Product description', $product->getDescription());
	}	

	public function test_meta_keywords_attribute_is_mutable()
	{
		$product = new Product;
		$product->setMetaKeywords('foo, bar, baz');

		$this->assertEquals('foo, bar, baz', $product->getMetaKeywords());
	}	

	public function test_meta_description_attribute_is_mutable()
	{
		$product = new Product;
		$product->setMetaDescription('meta description...');

		$this->assertEquals('meta description...', $product->getMetaDescription());
	}	

	public function test_availability_attribute_is_mutable()
	{
		$product = new Product;
		$availableOn = new \DateTime('yesterday');		
		$product->setAvailableOn($availableOn);

		$this->assertEquals($availableOn, $product->getAvailableOn());
	}			

	public function test_product_is_available_by_default()
	{
		$product = new Product;

		$this->assertEquals(true, $product->isAvailable());
	}	

	public function test_product_is_available_only_if_in_the_past()
	{
		// product available in the past
		$product = new Product;
        $product->setAvailableOn(new \DateTime('yesterday'));

        $this->assertEquals(true, $product->isAvailable());

		// product not available in the future
		$product = new Product;
        $product->setAvailableOn(new \DateTime('tomorrow'));

        $this->assertEquals(false, $product->isAvailable());        
	}	

	public function test_it_can_recieve_new_properties()
	{
		// build
		//$product = Product::create(['name' => 'Super Product']);
		//$properties = Property::where('type', '=', 'text')->take(3)->get();	
		//$product->setProperties($properties);

        // assert
        //$this->assertEquals($properties->keys(), $product->properties->keys());		
	}

	public function test_it_has_fluent_interface() 
	{
		$date = new \DateTime();
		$product = new Product;

		$this->assertEquals($product, $product->setName('Super Product'));
		$this->assertEquals($product, $product->setSlug('Super-Product'));
		$this->assertEquals($product, $product->setDescription('Super Product description'));
		$this->assertEquals($product, $product->setAvailableOn($date));
		$this->assertEquals($product, $product->setMetaDescription('SEO bla bla'));
		$this->assertEquals($product, $product->setMetaKeywords('foo, bar, baz'));		
	}					
}