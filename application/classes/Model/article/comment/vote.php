<?php defined('SYSPATH') OR die('No direct script access.');

class Model_Article_Comment_Vote extends ORM {

    protected $_table_name = 'article_comment_votes';

    protected $_belongs_to = array(
		'article_comment' => array(
			'model' => 'article_comment',
			'foreign_key' => 'comment_id',
		),
        'user' => array(
            'model' => 'user',
            'foreign_key' => 'user_id',
        ),
    );

    public static function is_author_comment($current_user_id, $user_id)
    {
        return $current_user_id == $user_id;
    }

    public static function already_voted($comment_id, $current_user_id)
    {
        $model = ORM::factory('article_comment_vote',
            array(
                'comment_id' => $comment_id,
                'user_id'    => $current_user_id,
            ));

        return $model->loaded();
    }

//    public function get_sum()
//    {
//        return $this->select(array(DB::expr('SUM(`value`)'), 'count_votes'))
//            ->find()
//            ->count_votes;
//    }
}