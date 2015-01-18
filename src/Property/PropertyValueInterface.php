<?php namespace Jiro\Product\Property;

/**
 * Property value interface.
 *
 * @author Andrew McLagan <andrewmclagan@gmail.com>
 */

interface PropertyValueInterface
{
    /**
     * returns the associated product.
     *
     * @return ProductInterface
     */
    public function product();

    /**
     * returns the associated property.
     *
     * @return PropertyInterface
     */
    public function property();

    /**
     * Set property.
     *
     * @param PropertyInterface $property
     */
    public function setProperty(PropertyInterface $property);

    /**
     * Set product.
     *
     * @param ProductInterface $product
     */
    public function setProduct(ProductInterface $product);    

    /**
     * Get property value.
     *
     * @return mixed
     */
    public function getValue();

    /**
     * Set property value.
     *
     * @param mixed $value
     */
    public function setValue($value);

    /**
     * Proxy method to access the name from real property.
     *
     * @return string
     */
    public function getName();

    /**
     * Proxy method to access the presentation from real property.
     *
     * @return string
     */
    public function getPresentation();

    /**
     * TProxy method to access the type of the property.
     *
     * @return string
     */
    public function getType();
}