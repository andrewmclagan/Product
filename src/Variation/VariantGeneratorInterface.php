<?php namespace Jiro\Product\Variation;

use Jiro\Product\ProductInterface;

/**
 * Interface for variant generating service.
 *
 * It is used to create all possible (non-existing) variations
 * of given object based on its options.
 *
 * @author Andrew McLagan <andrewmclagan@gmail.com>
 */

interface VariantGeneratorInterface
{
    /**
     * Generate all possible variants if they don't exist currently.
     *
     * @param ProductInterface $product
     */
    public function generate(ProductInterface $product);
}
