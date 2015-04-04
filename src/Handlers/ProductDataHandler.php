<?php namespace Jiro\Product\Handlers;

/**
 * Product Data Handler.
 *
 * @author Andrew McLagan <andrewmclagan@gmail.com>
 */

class ProductDataHandler implements ProductDataHandlerInterface {

	/**
	 * {@inheritDoc}
	 */
	public function prepare(array $data)
	{
		return $data;
	}

}
