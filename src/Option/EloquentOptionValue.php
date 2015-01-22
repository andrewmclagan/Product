<?php namespace Jiro\Product\Option;

use Illuminate\Database\Eloquent\Model;
use Jiro\Product\Option\OptionValueInterface;

/**
 * Option value.
 *
 * @author Andrew McLagan <andrewmclagan@gmail.com>
 */

class EloquentOptionValue extends Model implements OptionValueInterface
{
     /** 
     * {@inheritdoc}
     */
    protected $table = 'option_values';

    /** 
     * {@inheritdoc}
     */
    protected $fillable = [
        'value', 
        'option',
    ];

    /**
     * {@inheritdoc}
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * {@inheritdoc}
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function option()
    {
        return $this->hasOne('Jiro\Product\Option\EloquentOption');
    }

    /**
     * {@inheritdoc}
     */
    public function setOption(OptionInterface $option = null)
    {
        $this->option = $option;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        if (null === $this->option) {
            throw new \BadMethodCallException('The option have not been created yet so you cannot access proxy methods.');
        }

        return $this->option->getName();
    }

    /**
     * {@inheritdoc}
     */
    public function getPresentation()
    {
        if (null === $this->option) {
            throw new \BadMethodCallException('The option have not been created yet so you cannot access proxy methods.');
        }

        return $this->option->getPresentation();
    }
}
