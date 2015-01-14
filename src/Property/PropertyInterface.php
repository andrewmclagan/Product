<?php namespace Jiro\Product\Property;

/**
 * Property interface.
 *
 * @author Andrew McLagan <andrewmclagan@gmail.com>
 */

interface PropertyInterface
{
    /**
     * Returns all the properties products.
     *
     * @return Collection|ProductInterface[]
     */
    public function products();

    /**
     * Returns all the properties values.
     *
     * @return Collection|PropertyValueInterface[]
     */
    public function values();    

    /**
     * Get internal name.
     *
     * @return string
     */
    public function getName();

    /**
     * Set internal name.
     *
     * @param string $name
     */
    public function setName($name);

    /**
     * Get presentation name.
     *
     * @return string
     */
    public function getPresentation();

    /**
     * Set presentation name.
     *
     * @param string $name
     */
    public function setPresentation($name);    

    /**
     * The type of the property.
     *
     * @return string
     */
    public function getType();

    /**
     * Set type of the property.
     *
     * @param string $type
     */
    public function setType($type);

}