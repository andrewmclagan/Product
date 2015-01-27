<?php namespace Jiro\Product\Tests;

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
	public function it_can_recieve_multiple_property_values()
	{
		$product = Factory::create('Product');
		$properties = new Collection([
			Factory::create('PropertyValue'),
			Factory::create('PropertyValue'),
			Factory::create('PropertyValue'),
		]);

		$product->setProperties($properties);

        $this->assertEquals($properties->modelKeys(), $product->properties->modelKeys());				
    }

	/** @test */
	public function it_can_recieve_single_property_value()
	{
        $product = Factory::create('Product');
        $property = Factory::create('PropertyValue');

        $product->addProperty($property);

        $this->assertEquals($product->hasProperty($property), true);
	}    

	/** @test */
	public function it_can_check_if_it_has_a_property()
	{
        $product = Factory::create('Product');
        $property1 = Factory::create('PropertyValue');
        $property2 = Factory::create('PropertyValue');
        $product->addProperty($property1);

        $this->assertEquals(true, $product->hasProperty($property1));
        $this->assertEquals(false, $product->hasProperty($property2));
	}	

	/** @test */
	public function it_can_remove_a_property()
	{
        $product = Factory::create('Product');
        $property = Factory::create('PropertyValue');

        $product->addProperty($property);
        $product = $product->removeProperty($property)->fresh(); // rehydrate model

        $this->assertEquals([], $product->properties->toArray());
	}		

	/** @test */
	public function it_should_not_have_master_variant_by_default()
	{
		$product = Factory::create('Product');

		$this->assertEquals(false, $product->getMasterVariation());
	}

	/** @test **/
	public function its_master_variant_should_be_mutable_and_define_given_variant_as_master()
	{
        $product = Factory::create('Product');
        $variation = Factory::create('Variation');

		$product->setMasterVariation($variation);

		$this->assertEquals($product->getMasterVariation()->getKey(), $variation->getKey());
		$this->assertEquals($variation->isMaster(), true);
	}

	/** @test **/
	public function its_hasVariation_should_return_false_if_no_variation_defined()
	{
		$product = Factory::create('Product');
		$variation = Factory::create('Variation');

		$this->assertEquals($product->hasVariation($variation), false);
	}

	/** @test */
	public function it_can_recieve_single_variation()
	{
		$product = Factory::create('Product');
		$variation = Factory::create('Variation');

		$product->addVariation($variation);

		$this->assertEquals($product->hasVariation($variation), true);
	}

	/** @test */
	public function it_can_recieve_multiple_variations()
	{
		$product = Factory::create('Product');
		$variations = new Collection([
			Factory::create('Variation'),
			Factory::create('Variation'),
			Factory::create('Variation'),
		]);

		$product->setVariations($variations->all());

		$this->assertEquals($product->variations->modelKeys(), $variations->modelKeys());
	}	

	/** @test */
	public function it_can_remove_a_variation()
	{
		$product = Factory::create('Product');
		$variation = Factory::create('Variation');

		$product->addVariation($variation);
		$this->assertEquals($product->hasVariation($variation), true);

		$product = $product->removeVariation($variation)->fresh(); // rehydrate model
		$this->assertEquals($product->hasVariation($variation), false);		
	}

	/** @test */
	public function it_can_recieve_a_single_option()
	{
		$product = Factory::create('Product');
		$option = Factory::create('Option');

		$product->addOption($option);

		$this->assertEquals($product->hasOption($option), true);
	}

	/** @test */
	public function it_can_recieve_multiple_options()
	{	
		$product = Factory::create('Product');
		$options = new Collection([
			Factory::create('Option'),
			Factory::create('Option'),
			Factory::create('Option'),
		]);

		$product->setOptions($options);

		$this->assertEquals($product->options->modelKeys(), $options->modelKeys());		
	}

	/** @test */
	public function its_hasOption_should_return_false_if_no_option_defined()
	{
		$product = Factory::create('Product');
		$option = Factory::create('Option');

		$this->assertEquals($product->hasOption($option), false);
	}

	/** @test */
	public function its_hasOption_should_return_true_if_it_has_option()
	{
		$product = Factory::create('Product');
		$option = Factory::create('Option');

		$product->addOption($option);

		$this->assertEquals($product->hasOption($option), true);
	}	

	/** @test */
	public function it_should_remove_option_properly()
	{
		$product = Factory::create('Product');
		$option = Factory::create('Option');

		$product->addOption($option);
		$this->assertEquals($product->hasOption($option), true);

		$product = $product->removeOption($option)->fresh(); // rehydrate model
		$this->assertEquals($product->hasOption($option), false);

	}				
}