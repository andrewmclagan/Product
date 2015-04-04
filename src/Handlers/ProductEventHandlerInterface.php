<?php namespace Jiro\Product\Handlers;

use Jiro\Support\Event\EventHandlerInterface as BaseEventHandlerInterface;
use Jiro\Product\Database\ProductInterface;

/**
 * Product Event Handler Interface.
 *
 * @author Andrew McLagan <andrewmclagan@gmail.com>
 */

interface ProductEventHandlerInterface extends BaseEventHandlerInterface {

	/**
	 * When a product is being created.
	 *
	 * @param  array  $data
	 * @return mixed
	 */
	public function creating(array $data);

	/**
	 * When a product is created.
	 *
	 * @param  \Jiro\Product\Database\ProductInterface  $product
	 * @return mixed
	 */
	public function created(ProductInterface $product);

	/**
	 * When a product is being updated.
	 *
	 * @param  \Jiro\Product\Database\ProductInterface  $product
	 * @param  array  $data
	 * @return mixed
	 */
	public function updating(ProductInterface $product, array $data);

	/**
	 * When a product is updated.
	 *
	 * @param  \Jiro\Product\Database\ProductInterface  $product
	 * @return mixed
	 */
	public function updated(ProductInterface $product);

	/**
	 * When a product is deleted.
	 *
	 * @param  \Jiro\Product\Database\ProductInterface  $product
	 * @return mixed
	 */
	public function deleted(ProductInterface $product);

}
