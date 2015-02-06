<?php namespace Jiro\Product\Database\Eloquent;

use Jiro\Variation\Database\Eloquent\Variation as BaseVariation;
use Jiro\Product\VariationInterface;

/**
 * Object Variation model.
 *
 * @author Andrew McLagan <andrewmclagan@gmail.com>
 */

class Variation extends BaseVariation implements VariationInterface
{
    /**
     * {@inheritdoc}
     */
    public function product()
    {
        return $this->belongsTo('Jiro\Product\Database\Eloquent\Product');
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
}
