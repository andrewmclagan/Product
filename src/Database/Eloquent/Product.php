<?php namespace Jiro\Product\Database\Eloquent;

use Cartalyst\Attributes\EntityInterface;
use Platform\Attributes\Traits\EntityTrait;
use Jiro\Support\Database\NamespacedEntityTrait;
use Jiro\Support\Database\Eloquent\BaseModel;
use Jiro\Product\Database\ProductInterface;

class Product extends BaseModel implements EntityInterface, ProductInterface {

	use EntityTrait, NamespacedEntityTrait;

	/**
	 * {@inheritDoc}
	 */
	protected $table = 'products';

	/**
	 * {@inheritDoc}
	 */
	protected $guarded = [
		'id',
	];

	/**
	 * {@inheritDoc}
	 */
	protected $with = [
		'values.attribute',
	];

	/**
	 * {@inheritDoc}
	 */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        if (!array_key_exists('available_on', $attributes))
        {
            $this->setAvailableOn(new \Carbon\Carbon);
        }
    }	

   /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * {@inheritdoc}
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * {@inheritdoc}
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * {@inheritdoc}
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function isAvailable()
    {
        return new \DateTime() >= $this->available_on;
    }

    /**
     * {@inheritdoc}
     */
    public function getAvailableOn()
    {
        return $this->available_on;
    }

    /**
     * {@inheritdoc}
     */
    public function setAvailableOn(\DateTime $available_on = null)
    {
        $this->available_on = $available_on;

        return $this;
    }

}
