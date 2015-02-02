<?php namespace Jiro\Product\Tests;

use Laracasts\TestDummy\Factory;
use Illuminate\Database\Eloquent\Collection;

class EloquentOptionValueTest extends TestCase {

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

	/** 
	 * @test 
	 * @expectedException BadMethodCallException
	 */
	public function its_proxy_getName_method_returns_exception_when_option_not_set()
	{
		$value = Factory::create('OptionValue');

		$value->getName();
	}	

	/** 
	 * @test 
	 * @expectedException BadMethodCallException
	 */
	public function its_proxy_getPresentation_method_returns_exception_when_option_not_set()
	{
		$value = Factory::create('OptionValue');

		$value->getPresentation();
	}			

	/** @test */
	public function it_has_fluent_interface() 
	{
		$value = Factory::create('OptionValue');
		$option = Factory::create('Option');

		$this->assertEquals($value, $value->setValue('Takoyaki'));
		$this->assertEquals($value, $value->setOption($option));
	}					
}