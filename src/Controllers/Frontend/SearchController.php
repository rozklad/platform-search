<?php namespace Sanatorium\Search\Controllers\Frontend;

use Platform\Foundation\Controllers\Controller;

class SearchController extends Controller {

    /**
     * Return the main view.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $term = request()->get(trans('sanatorium/shop::general.search.input'));
        
        return view('sanatorium/search::index', compact('term'));
    }

}
