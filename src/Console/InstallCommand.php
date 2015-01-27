<?php namespace Jiro\Product\Console;

use Illuminate\Console\Command;
use Jiro\Support\Migration\IlluminateMigrationCreator;

// TODO: Write a full PHPSpec specification

class InstallCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'jiro:product:install';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Install the product package';	

	/**
	 * The migration generator.
	 *
	 * @var Jiro\Support\Migration\MigrationCreatorInterface
	 */
	protected $migrator;		

	/**
	 * constructor
	 *
	 * @param  \Jiro\Support\Migration\MigrationCreatorInterface $fileSystem
	 * @return void
	 */
	public function __construct(MigrationCreatorInterface $migrator)
	{
		parent::__construct();

		$this->migrator = $migrator;
	}	

	/**
	 * Execute the console command.
	 *
	 * @return void
	 */
	public function fire()
	{
		if ($this->migrate())
		{
			$this->info('Product migrations created successfully!');
		}
	}
}
