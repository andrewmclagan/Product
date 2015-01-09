<?php namespace Jiro\Product\Tests;

use TestCase;

class DbTestCase extends TestCase {

	/**
	 * Setup the DB before each test.
	 */
	public function setUp()
	{
		parent::setUp();

		// This should only do work for Sqlite DBs in memory.
		Artisan::call('migrate', '--bench="jiro/product"');

		// We'll run all tests through a transaction,
		// and then rollback afterward.
		DB::beginTransaction();
	}

	/**
	 * Rollback transactions after each test.
	 */
	public function tearDown()
	{
		DB::rollback();
	}

}