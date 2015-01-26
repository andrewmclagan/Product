<?php namespace Jiro\Product\Variation;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

/**
 * Object Variation model.
 *
 * @author Andrew McLagan <andrewmclagan@gmail.com>
 */

class EloquentVariation extends Model implements VariationInterface
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'variations';

    /**
     * White list of fillable attributes.
     *
     * @var array
     */
    protected $fillable = [
        'master', 
        'presentation', 
        'product', 
        'options',

    ];

    /**
     * Constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->master = false;
    }

    /**
     * {@inheritdoc}
     */
    public function isMaster()
    {
        return $this->master;
    }

    /**
     * {@inheritdoc}
     */
    public function setMaster($master)
    {
        $this->master = (Boolean) $master;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getPresentation()
    {
        return $this->presentation;
    }

    /**
     * {@inheritdoc}
     */
    public function setPresentation($presentation)
    {
        $this->presentation = $presentation;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function product()
    {
        return $this->belongsTo('Jiro\Product\EloquentProduct');
    }

    /**
     * {@inheritdoc}
     */
    public function setProduct($product = null)
    {
        if($product === null)
        {
            $this->product()->dissociate();
        }
        else 
        {
            $this->product()->associate($product);
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function options()
    {
        return $this->hasMany('Jiro\Product\Option\EloquentOptionValue', 'variation_id');
    }

    /**
     * {@inheritdoc}
     */
    public function setOptions($options)
    {
        $this->options()->saveMany($options);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function addOption($option)
    {
        $this->options()->save($option);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function removeOption($option)
    {
        $option->delete();

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function hasOption($option)
    {
        return $this->options->contains($option);
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaults($masterVariant)
    {
        if (!$masterVariant->isMaster()) 
        {
            throw new \InvalidArgumentException('Cannot inherit values from non master variant.');
        }

        if ($this->isMaster()) 
        {
            throw new \LogicException('Master variant cannot inherit from another master variant.');
        }

        if (!$masterVariant instanceof VariantInterface) 
        {
            throw new \InvalidArgumentException('Product variants must implement "Sylius\Component\Product\Model\VariantInterface".');
        }

        $this->setAvailableOn($masterVariant->getAvailableOn());

        return $this;
    }
}
