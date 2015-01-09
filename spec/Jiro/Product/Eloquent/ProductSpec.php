<?php namespace spec\Jiro\Product\Eloquent;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ProductSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Jiro\Product\Eloquent\Product');
    }

    function it_implements_Jiro_product_interface()
    {
        $this->shouldImplement('Jiro\Product\ProductInterface');
    }    

    function it_has_no_name_by_default()
    {
        $this->getName()->shouldReturn(null);
    }

    function its_name_should_be_mutable()
    {
    	$this->setName('Super Product');
    	$this->getName()->shouldReturn('Super Product');
    }

    function it_has_no_slug_by_default()
    {
        $this->getSlug()->shouldReturn(null);
    }    

    function its_slug_should_be_mutable()
    {
        $this->setSlug('Super-Product');
        $this->getSlug()->shouldReturn('Super-Product');
    }      

    function it_has_no_description_by_default()
    {
    	$this->getDescription()->shouldReturn(null);
    }

    function its_description_should_be_mutable()
    {
    	$this->setDescription('Super product description');
    	$this->getDescription()->shouldReturn('Super product description');
    }

    function it_has_no_meta_keywords_by_default()
    {
    	$this->getMetaKeywords()->shouldReturn(null);
    }

    function its_meta_keywords_should_be_mutable()
    {
    	$this->setMetaKeywords('foo, bar, baz');
    	$this->getMetaKeywords()->shouldReturn('foo, bar, baz');
    }

    function it_has_no_meta_description_by_default()
    {
    	$this->getMetaDescription()->shouldReturn(null);
    }

    function it_is_available_by_default()
    {
    	$this->isAvailable()->shouldReturn(true);
    }

    function its_availability_date_is_mutable()
    {
    	$availableOn = new \DateTime('yesterday');

    	$this->setAvailableOn($availableOn);
    	$this->getAvailableOn()->shouldReturn($availableOn);
    }

    function it_is_available_only_if_availability_date_is_in_past()
    {
        $availableOn = new \DateTime('yesterday');

        $this->setAvailableOn($availableOn);
        $this->shouldBeAvailable();

        $availableOn = new \DateTime('tomorrow');

        $this->setAvailableOn($availableOn);
        $this->shouldNotBeAvailable();    	
    }

    function it_has_fluent_interface()
    {
        $date = new \DateTime();

        $this->setName('Super Product')->shouldReturn($this);
        $this->setSlug('Super-Product')->shouldReturn($this);
        $this->setDescription('Super Product description')->shouldReturn($this);
        $this->setAvailableOn($date)->shouldReturn($this);
        $this->setMetaDescription('SEO bla bla')->shouldReturn($this);
        $this->setMetaKeywords('foo, bar, baz')->shouldReturn($this);
    }    
}
