<?php defined('SYSPATH') OR die('No direct script access.');

/**
 * Set the routes. Each route must have a minimum of a name, a URI and a set of
 * defaults for the URI.
 */

Route::set('user_profile', 'user/profile(/<action>(/<id>))')
	->defaults(array(
		'directory'  => 'user',
		'controller' => 'profile',
		'action'     => 'index',
	));

Route::set('user_settings', 'user/settings(/<action>(/<id>))')
	->defaults(array(
		'directory'  => 'user',
		'controller' => 'settings',
		'action'     => 'personal',
	));

Route::set('user_default', 'user(/<action>(/<id>))')
	->defaults(array(
		'controller' => 'user',
		'action'     => 'form',
	));

Route::set('articles', 'articles(/<id>)')
	->defaults(array(
		'controller' => 'articles',
		'action'     => 'index',
	));

Route::set('default', '(<controller>(/<action>(/<id>)))')
	->defaults(array(
		'controller' => 'articles',
		'action'     => 'index',
	));
