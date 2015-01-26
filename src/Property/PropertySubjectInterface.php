<?php namespace Jiro\Product\Property;

use Jiro\Product\Property\PropertyInterface;

/**
 * Gives the product "property" abilities
 *
 * @author Andrew McLagan <andrewmclagan@gmail.com>
 */

interface PropertySubjectInterface
{
    /**
     * Returns all the products properties.
     *
     * @return Collection|PropertyInterface[]
     */
    public function properties();

    /**
     * Sets all properties of the product.
     *
     * @param Collection $properties Array of PropertyValueInterface
     */
    public function setProperties($properties);

    /**
     * Adds a property to the product.
     *
     * @param PropertyInterface $property
     */
    public function addProperty(PropertyInterface $property);

    /**
     * Removes a property from the product.
     *
     * @param PropertyInterface $property
     */
    public function removeProperty(PropertyInterface $property);

    /**
     * Checks whether the product has a given property.
     *
     * @param PropertyInterface $property
     *
     * @return Boolean
     */
    public function hasProperty(PropertyInterface $property);

    /**
     * check if a property is present, by name
     *
     * @param string $propertyName
     *
     * @return Boolean
     */
    public function hasPropertyByName($propertyName);

    /**
     * Returns a property by name
     *
     * @param string $propertyName
     *
     * @return PropertyInterface
     */
    public function getPropertyByName($propertyName);    
}