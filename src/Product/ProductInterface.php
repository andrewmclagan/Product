<?php namespace Jiro\Product;

/**
 * Base product interface.
 *
 * @author Andrew McLagan <andrewmclagan@gmail.com>
 */

interface ProductInterface extends PropertySubjectInterface
{
   /**
     * Get product name.
     *
     * @return string
     */
    public function getName();

    /**
     * Set product name.
     *
     * @param string $name
     */
    public function setName($name);

    /**
     * Get permalink/slug.
     *
     * @return string
     */
    public function getSlug();

    /**
     * Set the permalink.
     *
     * @param string $slug
     */
    public function setSlug($slug);

    /**
     * Get product name.
     *
     * @return string
     */
    public function getDescription();

    /**
     * Set product description.
     *
     * @param string $description
     */
    public function setDescription($description);

    /**
     * Get meta keywords.
     *
     * @return string
     */
    public function getMetaKeywords();

    /**
     * Set meta keywords for the product.
     *
     * @param string $metaKeywords
     */
    public function setMetaKeywords($metaKeywords);

    /**
     * Get meta description.
     *
     * @return string
     */
    public function getMetaDescription();

    /**
     * Set meta description for the product.
     *
     * @param string $metaDescription
     */
    public function setMetaDescription($metaDescription);

    /**
     * Check whether the product is available.
     *
     * @return bool
     */
    public function isAvailable();

    /**
     * Return available on.
     *
     * @return \DateTime
     */
    public function getAvailableOn();

    /**
     * Set available on.
     *
     * @param null|\DateTime $availableOn
     */
    public function setAvailableOn(\DateTime $availableOn = null);   
}
