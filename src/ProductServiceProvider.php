<?php namespace Jiro\Product;

use Illuminate\Support\ServiceProvider;
use Jiro\Product\Console\InstallCommand;

class ProductServiceProvider extends ServiceProvider {

	/**
	 * {@inheritDoc}
	 */
	public function boot()
	{
		// Register the attributes namespace
		$this->app['platform.attributes.manager']->registerNamespace(
			$this->app['Jiro\Product\Database\Eloquent\Product']
		);

		// Subscribe the registered event handler
		$this->app['events']->subscribe('jiro.product.handler.event');
	}

	/**
	 * {@inheritDoc}
	 */
	public function register()
	{ 
		// Register the repository and model
		$this->app->bind('Jiro\Product\Database\Eloquent\ProductInterface', 'Jiro\Product\Database\Eloquent\Product');
		$this->app->bind('Jiro\Product\Database\ProductRepositoryInterface', 'Jiro\Product\Database\Eloquent\ProductRepository');

		// Register the data handler
		$this->app->bind('Jiro\Product\Handlers\ProductDataHandlerInterface', 'Jiro\Product\Handlers\ProductDataHandler');
		$this->app->bind('jiro.product.handler.data', 'Jiro\Product\Handlers\ProductDataHandlerInterface');

		// Register the event handler
		$this->app->bind('Jiro\Product\Handlers\ProductEventHandlerInterface', 'Jiro\Product\Handlers\ProductEventHandler');
		$this->app->bind('jiro.product.handler.event', 'Jiro\Product\Handlers\ProductEventHandlerInterface');

		// Register the validator
		$this->app->bind('Jiro\Product\Validator\ProductValidatorInterface', 'Jiro\Product\Validator\ProductValidator');
		$this->app->bind('jiro.product.validator', 'Jiro\Product\Validator\ProductValidatorInterface');

		// Register Commands
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
			return new InstallCommand($app['files'], $app['composer']);
		});

		$this->commands('command.jiro.product.install');
	}	
}
