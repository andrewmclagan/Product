<?php namespace Jiro\Product;

use Illuminate\Support\ServiceProvider;
use Jiro\Product\Property\PropertyInterface;
use Jiro\Product\Property\EloquentProperty;
use Jiro\Product\Property\PropertyValueInterface;
use Jiro\Product\Property\EloquentPropertyValue;
use Jiro\Product\Option\OptionInterface;
use Jiro\Product\Option\EloquentOption;
use Jiro\Product\Option\OptionValueInterface;
use Jiro\Product\Option\EloquentOptionValue;
use Jiro\Product\Variatiom\VariationInterface;
use Jiro\Product\Variatiom\EloquentVariation;
use Jiro\Product\Variatiom\VariationGeneratorInterface;
use Jiro\Product\Variatiom\VariationGenerator;

class ProductServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = true;

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind(ProductInterface::class, EloquentProduct::class);

		$this->app->bind(PropertyInterface::class, EloquentProperty::class);	
		$this->app->bind(PropertyValueInterface::class, EloquentPropertyValue::class);

		$this->app->bind(OptionInterface::class, EloquentOption::class);
		$this->app->bind(OptionValueInterface::class, EloquentOptionValue::class);

		$this->app->bind(VariationInterface::class, EloquentVariation::class);
		$this->app->bind(VariationGeneratorInterface::class, VariationGenerator::class);		

        $this->registerCommands();
	}		

	/**
	 * Register the product related console commands.
	 *
	 * @return void
	 */
	public function registerCommands()
	{
		$this->app->singleton('command.jiro.product.install', function($app)
		{
			return new Console\InstallCommand($app['files'], $app['composer']);
		});

		$this->commands('command.jiro.product.install');
	}	

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return [
			'Jiro\Product\Property\PropertyInterface',
			'Jiro\Product\Property\PropertyValueInterface',
			'Jiro\Product\Option\OptionInterface',
			'Jiro\Product\Option\OptionValueInterface',			
			'Jiro\Product\Variation\VariationInterface',
			'Jiro\Product\Variation\VariationGeneratorInterface',
			'Jiro\Product\ProductInterface',
		];
	}

}
