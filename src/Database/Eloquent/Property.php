<?php namespace Jiro\Product\Database\Eloquent;

use Jiro\Product\PropertyInterface;
use Jiro\Property\Database\Eloquent\Property as BaseProperty;

/**
 *  Model for properties.
 *
 *  This class must impliment the appropriate model relationship methods. See docs. 
 *
 * @author Andrew McLagan <andrewmclagan@gmail.com>
 */

class Property extends BaseProperty implements PropertyInterface {}
