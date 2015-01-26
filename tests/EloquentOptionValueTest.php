<?php namespace Jiro\Product\Tests;

use Laracasts\TestDummy\Factory;
use Illuminate\Database\Eloquent\Collection;

class EloquentOptionValueTest extends DbTestCase {

	/** @test */
	public function its_value_is_mutable()
	{
		$value = Factory::create('OptionValue');
		$value->setValue('Tuna');

		$this->assertEquals('Tuna', $value->getValue());		
	}

	/** @test */
	public function its_option_is_mutable()
	{
		$option = Factory::create('Option');
		$value = Factory::create('OptionValue');
		$value->setOption($option);

		$this->assertEquals($option->getKey(), $value->option->getKey());		
	}	

	/** @test */
	public function its_option_is_nullable()
	{
		$option = Factory::create('Option');
		$value = Factory::create('OptionValue');
		$value->setOption($option);

		$this->assertEquals($option->getKey(), $value->option->getKey());		

		$value->setOption(null);
		$this->assertEquals($value->option, null);
	}	

	/** @test */
	public function it_can_access_its_options_name()
	{
		$option = Factory::create('Option');
		$value = Factory::create('OptionValue');
		$value->setOption($option);
		$value->option->setName('Option Name');

		$this->assertEquals($value->getName(), 'Option Name');
	}	

	/** @test */
	public function it_can_access_its_options_presentation()
	{
		$option = Factory::create('Option');
		$value = Factory::create('OptionValue');
		$value->setOption($option);
		$value->option->setPresentation('Option Name');

		$this->assertEquals($value->getPresentation(), 'Option Name');
	}

	/** @test */
	public function its_proxy_methods_return_exceptions_when_option_not_set()
	{
		// TODO: write test on exceptions. If that is possible with PHPunit.
	}			

	/** @test */
	public function it_has_fluent_interface() 
	{
		$value = Factory::create('OptionValue');

		$this->assertEquals($value, $value->setValue('Takoyaki'));
		$this->assertEquals($value, $value->setOption(null));
	}					
}