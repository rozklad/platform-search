<?php namespace Sanatorium\Search\Widgets;

use Sanatorium\Search\Repositories\Searchquery\SearchqueryRepositoryInterface;
use DB;

class Queries {

	public function __construct(SearchqueryRepositoryInterface $searchquery)
	{
		$this->searchquery = $searchquery;
	}

	public function top($limit = 10, $object = null)
	{
		$top = $this->searchquery
	            ->select(DB::raw('count(*) as query_count, query'))
	            ->groupBy('query')
	            ->orderBy('query_count', 'DESC')
	            ->take($limit)
	            ->get();

	    $total = $this->searchquery->all()->count();

		return view('sanatorium/search::hooks/top', compact('top', 'total'));
	}
}