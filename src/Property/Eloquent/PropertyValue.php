<?php namespace Jiro\Property\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Jiro\Product\ProductInterface;

/**
 *  Model for product properties.
 *
 * @author Andrew McLagan <andrewmclagan@gmail.com>
 */

class PropertyValue extends Model implements PropertyValueInterface
{
    /** 
     * {@inheritdoc}
     */
    protected $table = 'property_values';

    /** 
     * {@inheritdoc}
     */
    protected $fillable = [
        'value', 
    ];

    /** 
     * {@inheritdoc}
     */
    public function product()
    {
        return null;
    }

    /** 
     * {@inheritdoc}
     */
    public function property()
    {
        return $this->hasOne('Property');
    }

    /** 
     * {@inheritdoc}
     */
    public function setProperty(PropertyInterface $property)
    {
        $property->values()->save($this);

        return $this;
    }

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
     * Proxy method to access the name from real property.
     *
     * @return mixed
     */
    protected function getPropertyAttribute($attribute)
    {
        if ($this->property instanceof PropertyInterface)
        {
            return $this->property->{$attribute};
        }

        return null;
    }    

    /** 
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->getPropertyAttribute('name');
    }

    /** 
     * {@inheritdoc}
     */
    public function getPresentation()
    {
        return $this->getPropertyAttribute('presentation');      
    }

    /** 
     * {@inheritdoc}
     */
    public function getType()
    {
        return $this->getPropertyAttribute('type');   
    }
}
