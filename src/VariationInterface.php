<?php namespace Jiro\Product;

use Jiro\Variation\VariationInterface as BaseVariationInterface;

/**
 * Model Variation interface.
 *
 * @author Andrew McLagan <andrewmclagan@gmail.com>
 */

interface VariationInterface extends BaseVariationInterface
{
    /**
     * Get product model.
     *
     * @return ProductInterface
     */
    public function product();

    /**
     * Set product mmodel.
     *
     * @param ProductInterface|null $product
     */
    public function setProduct(ProductInterface $product = null);
}
