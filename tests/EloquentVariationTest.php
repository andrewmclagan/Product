<?php namespace Jiro\Product\Tests;

use Illuminate\Database\Eloquent\Collection;
use Laracasts\TestDummy\Factory;

class EloquentVariationTest extends TestCase {

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
    public function it_should_have_ability_to_check_if_options_present()
    {    
        $product = Factory::create('Product');   
        $option = Factory::create('Option');   

        $this->assertEquals($product->hasOptions(), false);
        $product->addOption($option);
        $this->assertEquals($product->hasOptions(), true);
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
    public function its_option_values_should_be_mutable()
    {
    	$variation = Factory::create('Variation');
    	$options = new Collection([
			Factory::create('OptionValue'),
			Factory::create('OptionValue'),
			Factory::create('OptionValue'),
		]);

		$variation->setOptions($options->all());

		$this->assertEquals($variation->options->modelKeys(), $options->modelKeys());
    }

    /** @test */
    public function it_should_add_option_value_properly()
    {
    	$variation = Factory::create('Variation');
    	$option = Factory::create('OptionValue');	

    	$variation->addOption($option);

    	$this->assertEquals($variation->hasOption($option), true);
    }

    /** @test */
    public function it_should_remove_option_value_properly()
    {
    	$variation = Factory::create('Variation');
    	$option = Factory::create('OptionValue');	

    	$variation->addOption($option);
    	$this->assertEquals($variation->hasOption($option), true);    	

    	$variation = $variation->removeOption($option)->fresh();
    	$this->assertEquals($variation->hasOption($option), false);    	    	
    }

    /** 
     * @test 
     * @expectedException InvalidArgumentException
     */
    public function it_throws_exception_if_trying_to_inherit_values_from_a_non_master_variation()
    {
    	$variation = Factory::create('Variation');
        $masterVariation = Factory::create('Variation');
        
        $masterVariation->setMaster(false);

        $variation->setDefaults($masterVariation);
    }

    /** 
     * @test 
     * @expectedException LogicException
     */
    public function it_throws_exception_if_trying_to_inherit_values_and_being_a_master_variation()
    {
        $variation = Factory::create('Variation');
        $masterVariation = Factory::create('Variation');
        
        $masterVariation->setMaster(true);
        $variation->setMaster(true);

        $variation->setDefaults($masterVariation);
    }  

    /** 
     * @test 
     * @expectedException InvalidArgumentException
     */
    public function it_throws_exception_if_variation_is_incorrect_type()
    {
        $variation = Factory::create('Variation');
        $product = Factory::create('Product');

        $variation->setDefaults($product);
    }

	/** @test */
	public function it_has_fluent_interface() 
	{
		$variation = Factory::create('Variation');

		$this->assertEquals($variation, $variation->setPresentation('some name'));
	}					
}