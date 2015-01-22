<?php namespace Jiro\Product\Tests;

use Jiro\Product\EloquentProduct as Product;
use Jiro\Product\Property\EloquentProperty as Property;
use Illuminate\Database\Eloquent\Collection;
use Laracasts\TestDummy\Factory;
use Carbon\Carbon;

class EloquentProductTest extends DbTestCase {

	/** @test */
	public function its_name_attribute_is_mutable()
	{
		$product = Factory::create('Product');
		$product->setName('Takoyaki');

		$this->assertEquals('Takoyaki', $product->getName());
	}

	/** @test */
	public function its_slug_attribute_is_mutable()
	{
		$product = Factory::create('Product');
		$product->setSlug('Super-Product');

		$this->assertEquals('Super-Product', $product->getSlug());
	}	

	/** @test */
	public function its_description_attribute_is_mutable()
	{
		$product = Factory::create('Product');
		$product->setDescription('Product description');

		$this->assertEquals('Product description', $product->getDescription());
	}	

	/** @test */
	public function its_meta_keywords_attribute_is_mutable()
	{
		$product = Factory::create('Product');
		$product->setMetaKeywords('foo, bar, baz');

		$this->assertEquals('foo, bar, baz', $product->getMetaKeywords());
	}	

	/** @test */
	public function its_meta_description_attribute_is_mutable()
	{
		$product = Factory::create('Product');
		$product->setMetaDescription('meta description...');

		$this->assertEquals('meta description...', $product->getMetaDescription());
	}	

	/** @test */
	public function its_availability_attribute_is_mutable()
	{
		$product = Factory::create('Product');
		$availableOn = new Carbon('yesterday');		
		$product->setAvailableOn($availableOn);

		$this->assertEquals($availableOn, $product->getAvailableOn());
	}			

	/** @test */
	public function it_is_available_by_default()
	{
		$product = Factory::create('Product');

		$this->assertEquals(true, $product->isAvailable());
	}	

	/** @test */
	public function it_is_available_only_if_in_the_past()
	{
		// product available in the past
		$product = Factory::create('Product');
        $product->setAvailableOn(new Carbon('yesterday'));

        $this->assertEquals(true, $product->isAvailable());

		// product NOT available in the future
		$product = Factory::create('Product');
        $product->setAvailableOn(new Carbon('tomorrow'));

        $this->assertEquals(false, $product->isAvailable());        
	}	

	/** @test */
	public function it_can_recieve_new_properties()
	{
		// build multiple
		$product = Factory::create('Product');
		$properties = new Collection([
			Factory::create('SizeProperty'),
			Factory::create('ColourProperty'),
			Factory::create('MaterialProperty'),
		]);
		$product->setProperties($properties);

        // assert multiple
        $this->assertEquals($properties->modelKeys(), $product->properties->modelKeys());		

        // build single
        $product = Factory::create('Product');
        $property = Factory::create('SizeProperty');
        $product->addProperty($property);

        // assert single
        $this->assertEquals($property->getKey(), $product->properties[0]->getKey());		
	}

	/** @test */
	public function it_can_check_if_it_has_a_property()
	{
        $product = Factory::create('Product');
        $property1 = Factory::create('ColourProperty');
        $property2 = Factory::create('SizeProperty');
        $product->addProperty($property1);

        $this->assertEquals(true, $product->hasProperty($property1));
        $this->assertEquals(false, $product->hasProperty($property2));
	}	

	/** @test */
	public function it_can_check_if_it_has_a_property_by_name()
	{
        $product = Factory::create('Product');
        $property1 = Factory::create('ColourProperty');
        $property2 = Factory::create('SizeProperty');
        $product->addProperty($property1);

        $this->assertEquals(true, $product->hasPropertyByName('Colour'));
        $this->assertEquals(false, $product->hasPropertyByName('Size'));
	}		

	/** @test */
	public function it_can_remove_a_property()
	{
        $product = Factory::create('Product');
        $property = Factory::create('ColourProperty');

        $product->addProperty($property);
        $product->removeProperty($property);

        $product = Product::find(1);
        $this->assertEquals([], $product->properties->toArray());
	}	

	/** @test */
	public function it_can_return_a_property_by_name()
	{
        $product = Factory::create('Product');
        $property = Factory::create('ColourProperty');
        $product->addProperty($property);

        $product = Product::find(1); // Not Sure why we have to re-init from DB?
        $this->assertEquals($property->getKey(), $product->getPropertyByName('Colour')->getKey());
	}

	/** @test */
	public function it_has_fluent_interface() 
	{
		$date = new Carbon();
		$product = new Product;

		$this->assertEquals($product, $product->setName('Takoyaki'));
		$this->assertEquals($product, $product->setSlug('Super-Product'));
		$this->assertEquals($product, $product->setDescription('Super Product description'));
		$this->assertEquals($product, $product->setAvailableOn($date));
		$this->assertEquals($product, $product->setMetaDescription('SEO bla bla'));
		$this->assertEquals($product, $product->setMetaKeywords('foo, bar, baz'));		
	}					
}