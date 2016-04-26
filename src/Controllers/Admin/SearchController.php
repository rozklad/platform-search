<?php namespace Sanatorium\Search\Controllers\Admin;

use Platform\Access\Controllers\AdminController;

class SearchController extends AdminController {

    public function api()
    {
        $search = request()->get('search');

        // @todo - make pluggable
        return array_merge(
            $this->getMenuResults($search),
            $this->getPageResults($search)
        );
    }

    public function getMenuResults($search = null)
    {
        $menus = app('platform.menus');

        $results = $menus
            ->where('name', 'like', '%' . strtolower($search) . '%')
            ->where('menu', 1) // admin menu
            ->select(['name', 'uri', 'menu'])
            ->get();

        $output = [];

        foreach( $results as $item ) {

            $item = [
                'name' => $item->name,
                'description' => 'Menu item',
                'url' => admin_uri() . '/' . $item->uri
            ];

            $output[] = $item;

        }

        return $output;
    }

    public function getPageResults($search)
    {
        $pages = app('platform.pages');

        $results = $pages
            ->where('name', 'like', '%' . strtolower($search) . '%')
            ->select(['name', 'uri'])
            ->get();

        $output = [];

        foreach( $results as $item ) {

            $item = [
                'name' => $item->name,
                'description' => 'Page item',
                'url' => $item->uri
            ];

            $output[] = $item;

        }

        return $output;
    }
}
