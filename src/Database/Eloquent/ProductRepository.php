<?php namespace Jiro\Product\Database\Eloquent;

use Validator;
use Illuminate\Container\Container;
use Symfony\Component\Finder\Finder;
use Jiro\Support\Database\Eloquent\BaseRepository;
use Jiro\Product\Database\ProductRepositoryInterface;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface {

	/**
	 * Constructor.
	 *
	 * @param  \Illuminate\Container\Container  $app
	 * @return void
	 */
	public function __construct(Container $app)
	{
		parent::__construct($app);		

		$this->data = $app['jiro.product.handler.data'];

		$this->setValidator($app['jiro.product.validator']);

		$this->setModel(get_class($app['Jiro\Product\Database\Eloquent\Product']));	
	}

	/**
	 * {@inheritDoc}
	 */
	public function create(array $input)
	{
		// Create a new products
		$products = $this->createModel();

		// Fire the 'jiro.product.creating' event
		if ($this->fireEvent('jiro.product.creating', [ $input ]) === false)
		{
			return false;
		}

		// Prepare the submitted data
		$data = $this->data->prepare($input);

		// Validate the submitted data
		$messages = $this->validForCreation($data);

		// Check if the validation returned any errors
		if ($messages->isEmpty())
		{
			// Save the products
			$products->fill($data)->save();

			// Fire the 'jiro.product.created' event
			$this->fireEvent('jiro.product.created', [ $products ]);
		}

		return [ $messages, $products ];
	}

	/**
	 * {@inheritDoc}
	 */
	public function update($id, array $input)
	{
		// Get the products object
		$products = $this->find($id);

		// Fire the 'jiro.product.updating' event
		if ($this->fireEvent('jiro.product.updating', [ $products, $input ]) === false)
		{
			return false;
		}

		// Prepare the submitted data
		$data = $this->data->prepare($input);

		// Validate the submitted data
		$messages = $this->validForUpdate($products, $data);

		// Check if the validation returned any errors
		if ($messages->isEmpty())
		{
			// Update the products
			$products->fill($data)->save();

			// Fire the 'jiro.product.updated' event
			$this->fireEvent('jiro.product.updated', [ $products ]);
		}

		return [ $messages, $products ];
	}

	/**
	 * {@inheritDoc}
	 */
	public function delete($id)
	{
		// Check if the products exists
		if ($products = $this->find($id))
		{
			// Fire the 'jiro.product.deleted' event
			$this->fireEvent('jiro.product.deleted', [ $products ]);

			// Delete the products entry
			$products->delete();

			return true;
		}

		return false;
	}

	/**
	 * {@inheritDoc}
	 */
	public function getPreparedProduct($id)
	{
		if ( ! is_null($id))
		{
			if ( ! $product = $this->find($id)) return false;
		}
		else
		{
			$product = $this->createModel();
		}

		return compact('product');
	}	
		
	/**
	 * {@inheritDoc}
	 */
	public function enable($id)
	{
		$this->validator->bypass();

		return $this->update($id, [ 'enabled' => true ]);
	}

	/**
	 * {@inheritDoc}
	 */
	public function disable($id)
	{
		$this->validator->bypass();

		return $this->update($id, [ 'enabled' => false ]);
	}
}
