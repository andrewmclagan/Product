<?php namespace Jiro\Product;

use Jiro\Property\PropertyValueInterface as BasePropertyValueInterface;

/**
 * Property value interface.
 *
 * @author Andrew McLagan <andrewmclagan@gmail.com>
 */

interface PropertyValueInterface extends BasePropertyValueInterface
{
    /**
     * Get product model.
     *
     * @return ProductInterface
     */
    public function product();

    /**
     * Set product model.
     *
     * @param ProductInterface|null $subject
     */
    public function setProduct(ProductInterface $product = null);
}