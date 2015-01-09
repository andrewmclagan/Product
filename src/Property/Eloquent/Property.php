<?php namespace Jiro\Property\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Jiro\Property\PropertyInterface;
use Jiro\Property\PropertyTypes;
use Jiro\Product\ProductInterface;

/**
 *  Model for product properties.
 *
 * @author Andrew McLagan <andrewmclagan@gmail.com>
 */

class Property extends Model implements PropertyInterface
{
    /** 
     * {@inheritdoc}
     */
    protected $table = 'properties';

    /** 
     * {@inheritdoc}
     */
    protected $fillable = [
        'name', 
        'presentation', 
        'type', 
    ];

    public function __construct()
    {
        $this->type = PropertyTypes::TEXT;
    }    

    /** 
     * {@inheritdoc}
     */
    public function products()
    {
        return $this->belongsToMany('Product', 'product_property', 'property_id', 'product_id');
    }  

    /** 
     * {@inheritdoc}
     */
    public function values()
    {
        return $this->hasMany('PropertyValue');
    }     

    /** 
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->name;
    }

    /** 
     * {@inheritdoc}
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /** 
     * {@inheritdoc}
     */
    public function getPresentation()
    {
        return $this->presentation;
    }

    /** 
     * {@inheritdoc}
     */
    public function setPresentation($presentationName)
    {
        $this->presentation = $presentationName;
    }

    /** 
     * {@inheritdoc}
     */
    public function getType()
    {
        return $this->type;
    }

    /** 
     * {@inheritdoc}
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }
}
