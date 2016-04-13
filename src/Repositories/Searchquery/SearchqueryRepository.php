<?php namespace Sanatorium\Search\Repositories\Searchquery;

use Cartalyst\Support\Traits;
use Illuminate\Container\Container;
use Symfony\Component\Finder\Finder;

class SearchqueryRepository implements SearchqueryRepositoryInterface {

	use Traits\ContainerTrait, Traits\EventTrait, Traits\RepositoryTrait, Traits\ValidatorTrait;

	/**
	 * The Data handler.
	 *
	 * @var \Sanatorium\Search\Handlers\Searchquery\SearchqueryDataHandlerInterface
	 */
	protected $data;

	/**
	 * The Eloquent search model.
	 *
	 * @var string
	 */
	protected $model;

	/**
	 * Constructor.
	 *
	 * @param  \Illuminate\Container\Container  $app
	 * @return void
	 */
	public function __construct(Container $app)
	{
		$this->setContainer($app);

		$this->setDispatcher($app['events']);

		$this->data = $app['sanatorium.search.searchquery.handler.data'];

		$this->setValidator($app['sanatorium.search.searchquery.validator']);

		$this->setModel(get_class($app['Sanatorium\Search\Models\Searchquery']));
	}

	/**
	 * {@inheritDoc}
	 */
	public function grid()
	{
		return $this
			->createModel();
	}

	/**
	 * {@inheritDoc}
	 */
	public function findAll()
	{
		return $this->container['cache']->rememberForever('sanatorium.search.searchquery.all', function()
		{
			return $this->createModel()->get();
		});
	}

	/**
	 * {@inheritDoc}
	 */
	public function find($id)
	{
		return $this->container['cache']->rememberForever('sanatorium.search.searchquery.'.$id, function() use ($id)
		{
			return $this->createModel()->find($id);
		});
	}

	/**
	 * {@inheritDoc}
	 */
	public function validForCreation(array $input)
	{
		return $this->validator->on('create')->validate($input);
	}

	/**
	 * {@inheritDoc}
	 */
	public function validForUpdate($id, array $input)
	{
		return $this->validator->on('update')->validate($input);
	}

	/**
	 * {@inheritDoc}
	 */
	public function store($id, array $input)
	{
		return ! $id ? $this->create($input) : $this->update($id, $input);
	}

	/**
	 * {@inheritDoc}
	 */
	public function create(array $input)
	{
		// Create a new searchquery
		$searchquery = $this->createModel();

		// Fire the 'sanatorium.search.searchquery.creating' event
		if ($this->fireEvent('sanatorium.search.searchquery.creating', [ $input ]) === false)
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
			// Save the searchquery
			$searchquery->fill($data)->save();

			// Fire the 'sanatorium.search.searchquery.created' event
			$this->fireEvent('sanatorium.search.searchquery.created', [ $searchquery ]);
		}

		return [ $messages, $searchquery ];
	}

	/**
	 * {@inheritDoc}
	 */
	public function update($id, array $input)
	{
		// Get the searchquery object
		$searchquery = $this->find($id);

		// Fire the 'sanatorium.search.searchquery.updating' event
		if ($this->fireEvent('sanatorium.search.searchquery.updating', [ $searchquery, $input ]) === false)
		{
			return false;
		}

		// Prepare the submitted data
		$data = $this->data->prepare($input);

		// Validate the submitted data
		$messages = $this->validForUpdate($searchquery, $data);

		// Check if the validation returned any errors
		if ($messages->isEmpty())
		{
			// Update the searchquery
			$searchquery->fill($data)->save();

			// Fire the 'sanatorium.search.searchquery.updated' event
			$this->fireEvent('sanatorium.search.searchquery.updated', [ $searchquery ]);
		}

		return [ $messages, $searchquery ];
	}

	/**
	 * {@inheritDoc}
	 */
	public function delete($id)
	{
		// Check if the searchquery exists
		if ($searchquery = $this->find($id))
		{
			// Fire the 'sanatorium.search.searchquery.deleted' event
			$this->fireEvent('sanatorium.search.searchquery.deleted', [ $searchquery ]);

			// Delete the searchquery entry
			$searchquery->delete();

			return true;
		}

		return false;
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
