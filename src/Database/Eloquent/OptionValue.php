<?php namespace Jiro\Product\Database\Eloquent;

use Jiro\Product\OptionValueInterface;
use Jiro\Variation\Database\Eloquent\OptionValue as BaseOptionValue;

/**
 * Option value.
 *
 * @author Andrew McLagan <andrewmclagan@gmail.com>
 */

class OptionValue extends BaseOptionValue implements OptionValueInterface {}