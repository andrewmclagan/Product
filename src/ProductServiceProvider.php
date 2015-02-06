<?php namespace Jiro\Product;

use Illuminate\Support\ServiceProvider;
use Jiro\Product\Databse\Eloquent\Product;

/**
 * Product service provider
 *
 * @author Andrew McLagan <andrewmclagan@gmail.com>
 */

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
		$this->app->bind(ProductInterface::class, Product::class);		

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
			'Jiro\Product\ProductInterface',
		];
	}

}
