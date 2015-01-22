<?php namespace Jiro\Product\Migrations;

/**
 * Migraton Creator interface.
 *
 * @author Andrew McLagan <andrewmclagan@gmail.com>
 */

interface MigrationCreatorInterface
{
	/**
	 * Returns the migration stubs from a directory
	 *
	 * @param string $path
	 * @return array
	 */
	public function getMigrationStubs($path);

	/**
	 * Create migration files for the tables.
	 *
	 * @return string
	 */
	public function createMigrations();	

	/**
	 * Generates the filename and empty file for the migration
	 *
	 * @param  string  $migrationName
	 * @return string
	 */
	public function createMigrationFile($migrationName);

	/**
	 * Creates the content of the migration from a stub
	 *
	 * @param  string  $path
	 * @param  string  $stub
	 * @return void
	 */
	public function createMigrationContent($path, $stub);
}