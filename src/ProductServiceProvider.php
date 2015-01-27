<?php namespace Jiro\Product;

use Illuminate\Support\ServiceProvider;
use Jiro\Product\Property\EloquentProperty as Property;
use Jiro\Product\EloquentProduct as Product;

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
        $this->app->bind('Jiro\Product\Property\PropertyInterface', function()
        {
            return new Property;
        });
        $this->app->bind('Jiro\Product\Property\PropertyValueInterface', function()
        {
            return new PropertyValue;
        });  

        $this->app->bind('Jiro\Product\Option\OptionInterface', function()
        {
            return new Option;
        }); 
        $this->app->bind('Jiro\Product\Option\OptionValueInterface', function()
        {
            return new OptionValue;
        });   

        $this->app->bind('Jiro\Product\Variation\VariationInterface', function()
        {
            return new Variation;
        });                           
        
        $this->app->bind('Jiro\Product\ProductInterface', function()
        {
            return new Product;
        });   

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
			'Jiro\Product\ProductInterface',
		];
	}

}
