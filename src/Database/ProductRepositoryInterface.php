<?php namespace Jiro\Product\Database;

use Jiro\Support\Database\BaseRepositoryInterface;

interface ProductRepositoryInterface extends BaseRepositoryInterface {

	/**
	 * Returns a dataset compatible with data grid.
	 *
	 * @return \Andrewmclagan\Products\Models\Product
	 */
	public function grid();

	/**
	 * Returns all the products entries.
	 *
	 * @return \Andrewmclagan\Products\Models\Product
	 */
	public function findAll();

	/**
	 * Returns a products entry by its primary key.
	 *
	 * @param  int  $id
	 * @return \Andrewmclagan\Products\Models\Product
	 */
	public function find($id);

	/**
	 * Determines if the given products is valid for creation.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Support\MessageBag
	 */
	public function validForCreation(array $data);

	/**
	 * Determines if the given products is valid for update.
	 *
	 * @param  int  $id
	 * @param  array  $data
	 * @return \Illuminate\Support\MessageBag
	 */
	public function validForUpdate($id, array $data);

	/**
	 * Creates or updates the given products.
	 *
	 * @param  int  $id
	 * @param  array  $input
	 * @return bool|array
	 */
	public function store($id, array $input);

	/**
	 * Creates a products entry with the given data.
	 *
	 * @param  array  $data
	 * @return \Andrewmclagan\Products\Models\Product
	 */
	public function create(array $data);

	/**
	 * Updates the products entry with the given data.
	 *
	 * @param  int  $id
	 * @param  array  $data
	 * @return \Andrewmclagan\Products\Models\Product
	 */
	public function update($id, array $data);

	/**
	 * Gets a prepared product data set
	 *
	 * @param  int  $id
	 * @return array
	 */
	public function getPreparedProduct($id);

	/**
	 * Deletes the products entry.
	 *
	 * @param  int  $id
	 * @return bool
	 */
	public function delete($id);

}
