<?php namespace Jiro\Product;

use Illuminate\Support\ServiceProvider;
use Jiro\Property\EloquentProperty as Property;
use Jiro\EloquentProduct as Product;

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
			'Jiro\Product\ProductInterface',
		];
	}

}
