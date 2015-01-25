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

		$this->assertEquals($option->hasValue($valueOne), true);
		$this->assertEquals($option->hasValue($valueTwo), false);
	}

	/** @test */
	public function it_can_remove_an_option_value()
	{
		$option = Factory::create('Option');
		$value = Factory::create('OptionValue');

		$option->addValue($value);
		$this->assertEquals($option->hasValue($value), true);

		$option->removeValue($value);
		$option = $option->fresh(); // refresh our models collection
		$this->assertEquals($option->hasValue($value), false);
	}	

	/** @test */
	public function it_can_set_values_to_null()
	{	
		$option = Factory::create('Option');
		$optionValues = new Collection([
			Factory::create('OptionValue'),
			Factory::create('OptionValue'),
			Factory::create('OptionValue'),
		]);

		$option->setValues($optionValues->all());
		$this->assertEquals($option->values->keys(), $optionValues->keys());

		$option->setValues(null);
		$option = $option->fresh(); // refresh our models collection
		$this->assertEquals($option->values->count(), 0);
	}

	/** @test */
	public function it_can_remove_all_values()
	{	
		$option = Factory::create('Option');
		$optionValues = new Collection([
			Factory::create('OptionValue'),
			Factory::create('OptionValue'),
			Factory::create('OptionValue'),
		]);

		$option->setValues($optionValues->all());
		$this->assertEquals($option->values->keys(), $optionValues->keys());

		$option->removeAllValues();
		$option = $option->fresh(); // refresh our models collection
		$this->assertEquals($option->values->count(), 0);
	}	

	/** @test */
	public function it_has_fluent_interface() 
	{
		$option = Factory::create('Option');
		$value = Factory::create('OptionValue');
		$values = new Collection([
			Factory::create('OptionValue'),
			Factory::create('OptionValue'),
			Factory::create('OptionValue'),
		]);		

		$this->assertEquals($option, $option->setName('Takoyaki'));
		$this->assertEquals($option, $option->setPresentation('Takoyaki'));
		$this->assertEquals($option, $option->setValues($values->all()));
		$this->assertEquals($option, $option->addValue($value));
		$this->assertEquals($option, $option->removeValue($value));
		$this->assertEquals($option, $option->removeAllValues());
	}					
}