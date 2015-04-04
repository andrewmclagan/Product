<?php namespace Jiro\Product\Handlers; 

use Illuminate\Events\Dispatcher;
use Jiro\Support\Event\EventHandler as BaseEventHandler;
use Jiro\Product\Database\ProductInterface;

/**
 * Product Event Handler.
 *
 * @author Andrew McLagan <andrewmclagan@gmail.com>
 */

class ProductEventHandler extends BaseEventHandler implements ProductEventHandlerInterface {

	/**
	 * {@inheritDoc}
	 */
	public function subscribe(Dispatcher $dispatcher)
	{
		$dispatcher->listen('jiro.product.creating', __CLASS__.'@creating');
		$dispatcher->listen('jiro.product.created', __CLASS__.'@created');

		$dispatcher->listen('jiro.product.updating', __CLASS__.'@updating');
		$dispatcher->listen('jiro.product.updated', __CLASS__.'@updated');

		$dispatcher->listen('jiro.product.deleted', __CLASS__.'@deleted');
	}

	/**
	 * {@inheritDoc}
	 */
	public function creating(array $data)
	{

	}

	/**
	 * {@inheritDoc}
	 */
	public function created(ProductInterface $product)
	{
		$this->flushCache($product);
	}

	/**
	 * {@inheritDoc}
	 */
	public function updating(ProductInterface $product, array $data)
	{

	}

	/**
	 * {@inheritDoc}
	 */
	public function updated(ProductInterface $product)
	{
		$this->flushCache($product);
	}

	/**
	 * {@inheritDoc}
	 */
	public function deleted(ProductInterface $product)
	{
		$this->flushCache($product);
	}

	/**
	 * Flush the cache.
	 *
	 * @param  \Jiro\Product\Database\ProductInterface  $product
	 * @return void
	 */
	protected function flushCache(ProductInterface $product)
	{
		$this->app['cache']->forget('Jiro.product.all');

		$this->app['cache']->forget('Jiro.product.'.$product->id);
	}

}
