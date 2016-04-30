<?php namespace Sanatorium\Search\Widgets;

class Hooks {

	public function box($object = null)
	{
		return view('sanatorium/search::hooks/box');
	}

    public function admin()
    {
        return view('sanatorium/search::hooks/admin');
    }
}