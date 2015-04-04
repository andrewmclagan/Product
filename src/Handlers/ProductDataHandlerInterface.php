<?php namespace Jiro\Product\Handlers;

/**
 * Product Data Handler Interface.
 *
 * @author Andrew McLagan <andrewmclagan@gmail.com>
 */

interface ProductDataHandlerInterface {

	/**
	 * Prepares the given data for being stored.
	 *
	 * @param  array  $data
	 * @return mixed
	 */
	public function prepare(array $data);

}
