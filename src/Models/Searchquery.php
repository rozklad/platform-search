<?php namespace Sanatorium\Search\Models;

use Illuminate\Database\Eloquent\Model;

class Searchquery extends Model {

	/**
	 * {@inheritDoc}
	 */
	protected $table = 'shop_searchqueries';

	/**
	 * {@inheritDoc}
	 */
	protected $guarded = [
		'id',
	];


}
