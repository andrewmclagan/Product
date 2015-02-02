<?php namespace spec\Jiro\Product\Console;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class InstallCommandSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Jiro\Product\Console\InstallCommand');
    }

    function it_runs()
    {

    }
    
}
