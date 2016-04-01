<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Welcome extends Controller {

	public function action_index()
	{
		Model_Article_Comment::comment_belongs_to_user(41, 1);
	}

} // End Welcome