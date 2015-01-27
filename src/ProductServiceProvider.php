<?php namespace Jiro\Product;

use Illuminate\Support\ServiceProvider;

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
		$this->registerProperty();
		$this->registerPropertyValue();
		$this->registerOption();
		$this->registerOptionValue();
		$this->registerVariation();
		$this->registerProduct();
        $this->registerCommands();
	}

	/**
	 * Register Property model binding
	 *
	 * @return void
	 */
	public function registerProperty()
	{
        $this->app->bind('Jiro\Product\Property\PropertyInterface', function()
        {
            return new Property;
        });
	}

	/**
	 * Register Property Value model binding
	 *
	 * @return void
	 */
	public function registerPropertyValue()
	{
        $this->app->bind('Jiro\Product\Property\PropertyValueInterface', function()
        {
            return new PropertyValue;
        });  
	}	

	/**
	 * Register Option model binding
	 *
	 * @return void
	 */
	public function registerOption()
	{
        $this->app->bind('Jiro\Product\Option\OptionInterface', function()
        {
            return new Option;
        });
	}	

	/**
	 * Register Option Value model binding
	 *
	 * @return void
	 */
	public function registerOptionValue()
	{
        $this->app->bind('Jiro\Product\Option\OptionValueInterface', function()
        {
            return new OptionValue;
        }); 
	}	

	/**
	 * Register Variation model binding
	 *
	 * @return void
	 */
	public function registerVariation()
	{
        $this->app->bind('Jiro\Product\Variation\VariationInterface', function()
        {
            return new Variation;
        });   
	}	

	/**
	 * Register Product model binding
	 *
	 * @return void
	 */
	public function registerProduct()
	{
        $this->app->bind('Jiro\Product\ProductInterface', function()
        {
            return new Product;
        }); 
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
