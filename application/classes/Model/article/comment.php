<?php defined('SYSPATH') OR die('No direct script access.');

class Model_Article_Comment extends ORM {

	protected $_table_name = 'article_comments';

	// belongs to - принадлежит к
	// Комментарий принадлежит только одной статье, но статья может иметь много
	// комментариев
	// Комментарий принадлежит только одному пользователю, но пользователь может
	// иметь много комментариев
	protected $_belongs_to = array(
		'article' => array(
			'model' => 'Article',
			'foreign_key' => 'article_id',
		),
		'user' => array(
			'model' => 'User',
			'foreign_key' => 'user_id',
		),
	);

	// has many - имеет много
	// Комментарий может иметь много голосов, но голос принадлежит только одному
	// комментарию
	// Нужно использовать find_all()
	protected $_has_many = array(
		'votes' => array(
			'model' => 'Article_Comment_Vote',
			'foreign_key' => 'comment_id',
		)
	);

	/**
	 * Данный метод проверяет, принадлежит ли комментарий с данным идентификатором
	 * текущему пользователю
	 *
	 * @param   integer  $comment_id       id of comment
	 * @param   integer  $current_user_id  id of current user
	 * @return  bool
	 */
	public static function comment_belongs_to_user($comment_id, $current_user_id)
	{
		$user_id = ORM::factory('article_comment', $comment_id)->user_id;
		return $user_id == $current_user_id;
	}
}