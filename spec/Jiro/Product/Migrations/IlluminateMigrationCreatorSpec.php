<?php namespace spec\Jiro\Product\Migrations;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Filesystem\ClassFinder;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class IlluminateMigrationCreatorSpec extends ObjectBehavior
{
    function let(Filesystem $fileSystem, ClassFinder $classFinder)
    {
        $path = '/home/vagrant/development/Product/src/Migrations/stubs';
        $fileSystem->files($path)->willReturn([
            '/home/vagrant/development/Product/src/Migrations/stubs/product_property.stub',
            '/home/vagrant/development/Product/src/Migrations/stubs/products.stub',
            '/home/vagrant/development/Product/src/Migrations/stubs/properties.stub',
            '/home/vagrant/development/Product/src/Migrations/stubs/property_values.stub',
        ]);
        
        $classFinder->findClass()->willReturn('JiroClasses');

        $this->beConstructedWith($fileSystem, $classFinder);
    }    

    function it_is_initializable()
    {
        $this->shouldHaveType('Jiro\Product\Migrations\IlluminateMigrationCreator');
    }

    function it_implements_Jiro_migration_creator_interface()
    {
        $this->shouldImplement('Jiro\Product\Migrations\MigrationCreatorInterface');
    }    

    function it_returns_a_list_of_migration_stub_paths(Filesystem $fileSystem)
    {
    	$this->getMigrationStubs()->shouldReturn('JiroClasses');
    }
}
