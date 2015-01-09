<?php namespace Jiro\Product\Tests;

use Illuminate\Foundation\Testing\TestCase;
use Artisan, DB;

abstract class DbTestCase extends TestCase {

	/**
	 * Boots the application.
	 *
	 * @return \Illuminate\Foundation\Application
	 */
	public function createApplication()
	{
		$app = require __DIR__.'/../../../../bootstrap/app.php';

		$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

		return $app;		
	}	

	/**
	 * Setup the DB before each test.
	 */
	public function setUp()
	{ 
		parent::setUp();

		// This should only do work for Sqlite DBs in memory.
		Artisan::call('migrate', ['--bench'=>'jiro/product']);

		// // We'll run all tests through a transaction,
		// // and then rollback afterward.
		//DB::beginTransaction();
	}

	/**
	 * Rollback transactions after each test.
	 */
	public function tearDown()
	{
		//DB::rollback();
	}

}