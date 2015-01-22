<?php namespace spec\Jiro\Product\Console;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\Composer;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class InstallCommandSpec extends ObjectBehavior
{
    function let(Filesystem $fileSystem, Composer $composer)
    {
        $this->beConstructedWith($fileSystem, $composer);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Jiro\Product\Console\InstallCommand');
    }
    
}
