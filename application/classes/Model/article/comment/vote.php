<?php defined('SYSPATH') OR die('No direct script access.');

class Model_Article_Comment_Vote extends ORM {

    protected $_table_name = 'article_comment_votes';

    // belongs to - принадлежит к
    // Голос принадлежит только одному комментарию, но комментарий может иметь
    // много голосов
    // Голос принадлежит только одному пользователю, но пользователь может иметь
    // много голосов
    protected $_belongs_to = array(
		'comment' => array(
			'model' => 'Article_Comment',
			'foreign_key' => 'comment_id',
		),
        'user' => array(
            'model' => 'User',
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

    public function get_sum_votes_comment()
    {
        $result = $this->select(array(DB::expr('SUM(`value`)'), 'sum_votes'))
            ->find_all()
            ->get('sum_votes', 0);

        return $result;
    }

    public static function get_sum_votes_user($user_id)
    {
        $result = DB::select(array(DB::expr('SUM(`value`)'), 'sum_votes'))
            ->from('users')
            ->join('article_comments')
            ->on('users.id', '=', 'article_comments.user_id')
            ->join('article_comment_votes')
            ->on('article_comments.id', '=', 'article_comment_votes.comment_id')
            ->where('users.id', '=', $user_id)
            ->execute()
            ->get('sum_votes', 0);

        return $result;
    }
}