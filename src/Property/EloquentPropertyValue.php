<?php namespace Jiro\Product\Property;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Jiro\Product\ProductInterface;
use Jiro\Product\Property\PropertyInterface;

/**
 *  Model for product properties.
 *
 * @author Andrew McLagan <andrewmclagan@gmail.com>
 */

class EloquentPropertyValue extends Model implements PropertyValueInterface
{
    use SoftDeletes;
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'property_values';

    /**
     * White list of fillable attributes.
     *
     * @var array
     */
    protected $fillable = [
        'value', 
    ];

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
    public function property()
    {
        return $this->belongsTo('Jiro\Product\Property\EloquentProperty');
    }

    /** 
     * {@inheritdoc}
     */
    public function setProperty(PropertyInterface $property)
    {
        $this->property()->associate($property);

        return $this;
    }

    /** 
     * {@inheritdoc}
     */
    public function setProduct(ProductInterface $product)
    {
        $this->product()->associate($product);

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
     * {@inheritdoc}
     */
    public function getName()
    {
        if($this->property)
        {
            return $this->property->getName();
        }
    }

    /** 
     * {@inheritdoc}
     */
    public function getPresentation()
    {
        if($this->property)
        {
            return $this->property->getPresentation();
        }
    }

    /** 
     * {@inheritdoc}
     */
    public function getType()
    {
        if($this->property)
        {
            return $this->property->getType();
        }
    }
}
