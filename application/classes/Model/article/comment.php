<?php defined('SYSPATH') OR die('No direct script access.');

class Model_Article_Comment extends ORM {

	protected $_table_name = 'article_comments';

	protected $_belongs_to = array(
		'article' => array(
			'model' => 'article',
			'foreign_key' => 'article_id',
		),
		'user' => array(
			'model' => 'user',
			'foreign_key' => 'user_id',
		),
	);

	protected $_has_many = array(
		'votes' => array(
			'model' => 'article',
			'foreign_key' => 'article_id',
		)
	);
}
