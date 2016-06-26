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
        return view('sanatorium/search::index');
    }

}
