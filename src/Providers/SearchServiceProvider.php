<?php namespace Sanatorium\Search\Providers;

use Cartalyst\Cart\Cart;
use Cartalyst\Cart\Storage\IlluminateSession;
use Cartalyst\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;
use Sentinel;

class SearchServiceProvider extends ServiceProvider {

	/**
	 * {@inheritDoc}
	 */
	public function boot()
	{
		// Register all the default hooks
        $this->registerHooks();

        // List search query if given
        if ( request()->has( trans('sanatorium/shop::general.search.input') ) ) {
            $searchquery = app('sanatorium.search.searchquery');

            $item = [
                'query' => request()->get( trans('sanatorium/shop::general.search.input') ),
                'ip'    => request()->ip()
            ];

            if ( request()->has( 'user_id' ) ) {
                $item['user_id'] = request()->get( 'user_id' );
            }

            $searchquery->create($item);
        }
	}

	/**
	 * {@inheritDoc}
	 */
	public function register()
	{
        // Register the repository
        $this->bindIf('sanatorium.search.searchquery', 'Sanatorium\Search\Repositories\Searchquery\SearchqueryRepository');
	
        // Register the data handler
        $this->bindIf('sanatorium.search.searchquery.handler.data', 'Sanatorium\Search\Handlers\Searchquery\SearchqueryDataHandler');

        // Register the event handler
        $this->bindIf('sanatorium.search.searchquery.handler.event', 'Sanatorium\Search\Handlers\Searchquery\SearchqueryEventHandler');

        // Register the validator
        $this->bindIf('sanatorium.search.searchquery.validator', 'Sanatorium\Search\Validator\Searchquery\SearchqueryValidator');

    }

    /**
     * Register all hooks.
     *
     * @return void
     */
    protected function registerHooks()
    {
        $hooks = [
            [
                'position' => 'shop.search',
                'hook' => 'sanatorium/search::hooks.box'
            ],
            [
                'position' => 'admin.scripts.footer',
                'hook' => 'sanatorium/search::hooks.admin'
            ]
        ];

        $manager = $this->app['sanatorium.hooks.manager'];

        foreach ($hooks as $item) {
            extract($item);
            $manager->registerHook($position, $hook);
        }
    }

}
