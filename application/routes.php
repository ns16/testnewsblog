<?php defined('SYSPATH') OR die('No direct script access.');

/**
 * Set the routes. Each route must have a minimum of a name, a URI and a set of
 * defaults for the URI.
 */

Route::set('favorites', 'favorites/index(/<id>)')
	->defaults(array(
		'controller' => 'favorites',
		'action'     => 'index',
	));

Route::set('favorites_default', 'favorites(/<controller>(/<action>(/<id>)))')
	->defaults(array(
		'directory'  => 'favorites',
		'controller' => 'profile',
		'action'     => 'index',
	));

Route::set('user', 'user/form(/<id>)')
	->defaults(array(
		'controller' => 'user',
		'action'     => 'form',
	));

Route::set('user_default', 'user(/<controller>(/<action>(/<id>)))')
	->defaults(array(
		'directory'  => 'user',
		'controller' => 'profile',
		'action'     => 'index',
	));

Route::set('articles', 'articles(/<id>)')
	->defaults(array(
		'controller' => 'articles',
		'action'     => 'view',
	));

Route::set('default', '(<controller>(/<action>(/<id>)))')
	->defaults(array(
		'controller' => 'articles',
		'action'     => 'view',
	));
