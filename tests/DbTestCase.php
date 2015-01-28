<?php namespace Jiro\Product\Tests;

use Illuminate\Foundation\Testing\TestCase;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Filesystem\ClassFinder;
use Jiro\Support\Migration\MigratorInterface;

abstract class DbTestCase extends TestCase {

	/**
	 * The migration creator instance 
	 *
	 * @param Jiro\Support\Migration\MigratorInterface $migrator
	 */
	protected $migrator;

	/**
	 * Constructor
	 */
	public function __construct(/*MigratorInterface $migrator*/)
	{
		parent::__construct();

		//$this->migrator = $migrator;
	}

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
	 * @return void
	 */
	public function migrate()
	{ 
		(new MigratorInterface)->migrate();
	}			
}