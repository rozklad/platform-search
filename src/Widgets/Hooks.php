<?php namespace Sanatorium\Search\Widgets;

class Hooks {

	public function box($css_classes = null)
	{
		return view('sanatorium/search::hooks/box', compact('css_classes'));
	}

    public function admin()
    {
        return view('sanatorium/search::hooks/admin');
    }
}