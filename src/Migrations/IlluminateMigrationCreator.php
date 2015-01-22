<?php namespace Jiro\Product\Migrations;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Filesystem\ClassFinder;

class IlluminateMigrationCreator implements MigrationCreatorInterface 
{
	/**
	 * The filesystem instance.
	 *
	 * @var \Illuminate\Filesystem\Filesystem
	 */
	protected $fileSystem; 

	/**
	 * The classfinder instance.
	 *
	 * @var \Illuminate\Filesystem\ClassFinder
	 */
	protected $classFinder;

	/**
	 * constructor
	 *
	 * @param  \Illuminate\Filesystem\Filesystem $fileSystem
	 * @param  \Illuminate\Foundation\Composer $composer
	 * @return void
	 */
	public function __construct(Filesystem $fileSystem, ClassFinder $classFinder)
	{
		$this->fileSystem = $fileSystem;
		$this->classFinder = $classFinder;
	}

    /**
     * {@inheritdoc}
     */
	public function getMigrationStubs($path = __DIR__.'/stubs')
	{
		$stubs = [];

		foreach($this->fileSystem->files($path) as $file) 
		{
			$migrationName = $this->classFinder->findClass($file);
	
			$this->stubs[] = [ $migrationName => $file ];
		}		

		return $stubs;	
	}	

    /**
     * {@inheritdoc}
     */
	public function createMigrations()
	{
		foreach($this->getMigrationStubs() as $migrationName => $stubFile)
		{
			$path = $this->createMigrationFile($migrationName);

			$this->createMigrationContent($path, $stubFile);
		}
	}

    /**
     * {@inheritdoc}
     */
	public function createMigrationFile($migrationName)
	{

	}

    /**
     * {@inheritdoc}
     */
	public function createMigrationContent($path, $stub)
	{

	}	
}