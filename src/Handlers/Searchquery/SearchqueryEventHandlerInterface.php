<?php namespace Sanatorium\Search\Handlers\Searchquery;

use Sanatorium\Search\Models\Searchquery;
use Cartalyst\Support\Handlers\EventHandlerInterface as BaseEventHandlerInterface;

interface SearchqueryEventHandlerInterface extends BaseEventHandlerInterface {

	/**
	 * When a searchquery is being created.
	 *
	 * @param  array  $data
	 * @return mixed
	 */
	public function creating(array $data);

	/**
	 * When a searchquery is created.
	 *
	 * @param  \Sanatorium\Search\Models\Searchquery  $searchquery
	 * @return mixed
	 */
	public function created(Searchquery $searchquery);

	/**
	 * When a searchquery is being updated.
	 *
	 * @param  \Sanatorium\Search\Models\Searchquery  $searchquery
	 * @param  array  $data
	 * @return mixed
	 */
	public function updating(Searchquery $searchquery, array $data);

	/**
	 * When a searchquery is updated.
	 *
	 * @param  \Sanatorium\Search\Models\Searchquery  $searchquery
	 * @return mixed
	 */
	public function updated(Searchquery $searchquery);

	/**
	 * When a searchquery is deleted.
	 *
	 * @param  \Sanatorium\Search\Models\Searchquery  $searchquery
	 * @return mixed
	 */
	public function deleted(Searchquery $searchquery);

}
