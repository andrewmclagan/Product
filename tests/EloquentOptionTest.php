<?php namespace Jiro\Product\Tests;

use Laracasts\TestDummy\Factory;
use Illuminate\Database\Eloquent\Collection;

class EloquentOptionTest extends DbTestCase {

	/** @test */
	public function its_name_is_mutable()
	{
		$option = Factory::create('Option');
		$option->setName('Rice Type');

		$this->assertEquals('Rice Type', $option->getName());		
	}

	/** @test */
	public function its_presentation_is_mutable()
	{
		$option = Factory::create('Option');
		$option->setPresentation('Soup option');

		$this->assertEquals('Soup option', $option->getPresentation());		
	}	

	/** @test */
	public function it_can_recieve_multiple_option_values()
	{
		$option = Factory::create('Option');

		$optionValues = new Collection([
			Factory::create('OptionValue'),
			Factory::create('OptionValue'),
			Factory::create('OptionValue'),
		]);

		$option->setValues($optionValues->all());

		$this->assertEquals($option->values->keys(), $optionValues->keys());
	}		

	/** @test */
	public function it_can_recieve_a_single_option_value()
	{
		$option = Factory::create('Option');
		$valueOne = Factory::create('OptionValue');
		$valueTwo = Factory::create('OptionValue');

		$option->addValue($valueOne);

		$this->assertEquals($option->values->contains($valueOne), true);
		$this->assertEquals($option->values->contains($valueTwo), false);
	}

	/** @test */
	public function it_can_remove_an_option_value()
	{
		$option = Factory::create('Option');
		$value = Factory::create('OptionValue');

		$option->addValue($value);
		$this->assertEquals($option->values->contains($value), true);

		$option->removeValue($value);
		$this->assertEquals($option->values->contains($value), false);
	}	

	/** @test */
	public function it_has_fluent_interface() 
	{
		
	}					
}