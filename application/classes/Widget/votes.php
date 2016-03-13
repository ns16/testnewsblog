<?php defined('SYSPATH') or die('No direct script access.');

class Widget_Votes extends Widget {

    /**
     * @var  Model_Article_Comment|NULL  comment to article
     */
    protected $comment = NULL;

    public function run()
    {
        $view = View::factory('widget/votes');

//        $result = DB::select(array(DB::expr('SUM(`value`)'), 'count_votes'))
//            ->from('article_comment_votes')
//            ->where('comment_id', '=', $this->comment->id)
//            ->execute();

        $count_votes = $this->comment->votes->get_count_votes();

//        $count_votes = $result->get('count_votes', 0);
        $current_user_id = isset($this->user) ? $this->user->id : NULL;

        $view->set(array(
            'count_votes'     => $count_votes,
            'article_id'      => $this->comment->article_id,
            'comment_id'      => $this->comment->id,
            'user_id'         => $this->comment->user_id,
            'current_user_id' => $current_user_id,
        ));

        return $view;
    }
}