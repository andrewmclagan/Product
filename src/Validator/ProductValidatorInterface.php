<?php namespace Jiro\Product\Validator;

/**
 * Product Validator Interface.
 *
 * @author Andrew McLagan <andrewmclagan@gmail.com>
 */

interface ProductValidatorInterface {

	/**
	 * Updating a products scenario.
	 *
	 * @return void
	 */
	public function onUpdate();

}
