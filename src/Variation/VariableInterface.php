<?php namespace Jiro\Product\Variation;

use Jiro\Product\Option\OptionInterface;

/**
 * Should be implemented by models that support variations and options.
 *
 * @author Andrew McLagan <andrewmclagan@gmail.com>
 */

interface VariableInterface
{
    /**
     * Returns master variation.
     *
     * @return VariationInterface
     */
    public function getMasterVariation();

    /**
     * Sets master variation.
     *
     * @param VariationInterface $variation
     */
    public function setMasterVariation(VariationInterface $variation);

    /**
     * Returns all object variations.
     * This collection should exclude the master variation.
     *
     * @return Collection|VariationInterface[]
     */
    public function variations();

    /**
     * Sets all object variations.
     *
     * @param Collection $variations
     */
    public function setVariations($variations);

    /**
     * Adds variation.
     *
     * @param VariationInterface $variation
     */
    public function addVariation(VariationInterface $variation);

    /**
     * Removes variation from object.
     *
     * @param VariationInterface $variation
     */
    public function removeVariation(VariationInterface $variation);

    /**
     * Checks whether object has given variation.
     *
     * @param VariationInterface $variation
     *
     * @return Boolean
     */
    public function hasVariation(VariationInterface $variation);

    /**
     * Returns all object options.
     *
     * @return Collection|OptionInterface[]
     */
    public function options();

    /**
     * Sets all object options.
     *
     * @param Collection $options
     */
    public function setOptions($options);

    /**
     * Adds option.
     *
     * @param OptionInterface $option
     */
    public function addOption(OptionInterface $option);

    /**
     * Removes option from product.
     *
     * @param OptionInterface $option
     */
    public function removeOption(OptionInterface $option);

    /**
     * Checks whether object has given option.
     *
     * @param OptionInterface $option
     *
     * @return Boolean
     */
    public function hasOption(OptionInterface $option);

    /**
     * Checks for presence of product options
     *
     * @return Boolean
     */
    public function hasOptions();    
}
