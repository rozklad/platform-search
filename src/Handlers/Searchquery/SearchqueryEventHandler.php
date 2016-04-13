<?php namespace Sanatorium\Search\Handlers\Searchquery;

use Illuminate\Events\Dispatcher;
use Sanatorium\Search\Models\Searchquery;
use Cartalyst\Support\Handlers\EventHandler as BaseEventHandler;

class SearchqueryEventHandler extends BaseEventHandler implements SearchqueryEventHandlerInterface {

	/**
	 * {@inheritDoc}
	 */
	public function subscribe(Dispatcher $dispatcher)
	{
		$dispatcher->listen('sanatorium.search.searchquery.creating', __CLASS__.'@creating');
		$dispatcher->listen('sanatorium.search.searchquery.created', __CLASS__.'@created');

		$dispatcher->listen('sanatorium.search.searchquery.updating', __CLASS__.'@updating');
		$dispatcher->listen('sanatorium.search.searchquery.updated', __CLASS__.'@updated');

		$dispatcher->listen('sanatorium.search.searchquery.deleted', __CLASS__.'@deleted');
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
	public function created(Searchquery $searchquery)
	{
		$this->flushCache($searchquery);
	}

	/**
	 * {@inheritDoc}
	 */
	public function updating(Searchquery $searchquery, array $data)
	{

	}

	/**
	 * {@inheritDoc}
	 */
	public function updated(Searchquery $searchquery)
	{
		$this->flushCache($searchquery);
	}

	/**
	 * {@inheritDoc}
	 */
	public function deleted(Searchquery $searchquery)
	{
		$this->flushCache($searchquery);
	}

	/**
	 * Flush the cache.
	 *
	 * @param  \Sanatorium\Search\Models\Searchquery  $searchquery
	 * @return void
	 */
	protected function flushCache(Searchquery $searchquery)
	{
		$this->app['cache']->forget('sanatorium.search.searchquery.all');

		$this->app['cache']->forget('sanatorium.search.searchquery.'.$searchquery->id);
	}

}
