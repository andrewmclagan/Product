<?php namespace Jiro\Product\Tests;

use Illuminate\Foundation\Testing\TestCase;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Filesystem\ClassFinder;

abstract class DbTestCase extends TestCase {

	/**
	 * Boots the application.
	 *
	 * @return \Illuminate\Foundation\Application
	 */
	public function createApplication()
	{
		$app = require __DIR__.'/../vendor/laravel/laravel/bootstrap/app.php';

		$app->register('Jiro\Product\ProductServiceProvider');

		$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

		return $app;		
	}	

	/**
	 * Setup DB before each test.
	 *
	 * @return void	 
	 */
	public function setUp()
	{ 
		parent::setUp();

		$this->app['config']->set('database.default','sqlite');	
		$this->app['config']->set('database.connections.sqlite.database', ':memory:');

		$this->migrate();
	}

	/**
	 * run package database migrations
	 *
	 * @param string $operation
	 * @return void
	 */
	public function migrate($operation = 'up')
	{ 
		$fileSystem = new Filesystem;
		$classFinder = new ClassFinder;

		foreach($fileSystem->files(__DIR__ . "/../src/Migrations") as $file)
		{
			$fileSystem->requireOnce($file);
			$migrationClass = $classFinder->findClass($file);
			
			(new $migrationClass)->{$operation}();
		}
	}			
}