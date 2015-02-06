<?php namespace Jiro\Product\Property;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Jiro\Product\ProductInterface;
use Jiro\Product\PropertyValueInterface;
use Jiro\Property\Database\Eloquent\PropertyValue as BasePropertyValue;

/**
 *  Model for property values.
 *
 *  This abstract class must impliment the appropriate methods. See docs.
 *
 * @author Andrew McLagan <andrewmclagan@gmail.com>
 */

class PropertyValue extends BasePropertyValue implements PropertyValueInterface
{
    /**
     * {@inheritdoc}
     */
    public function product()
    {
        return $this->hasOne('Jiro\Product\Database\Eloquent\Product','subject_id');
    }

    /**
     * {@inheritdoc}
     */
    public function setProduct(ProductInterface $product = null)
    {
        $this->product()->associate($product);

        return $this;
    }
}
