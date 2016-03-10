<?php defined('SYSPATH') or die('No direct script access.');

class Widget_Votes extends Widget {

    /**
     * @var  Model_Article_Comment|NULL  comment to article
     */
    protected $comment = NULL;

    public function run()
    {
        $view = View::factory('widget/votes');

        $result = DB::select(array(DB::expr('SUM(`value`)'), 'count_votes'))
            ->from('article_comment_votes')
            ->where('comment_id', '=', $this->comment->id)
            ->execute();

//        $result = $this->comment->votes->get_sum();

        $count_votes = $result->get('count_votes', 0);

        $current_user = Auth::instance()->get_user();
        $current_user_id = $current_user ? $current_user->id : NULL;

        $view
            ->set('count_votes', $count_votes)
            ->set('article_id', $this->comment->article_id)
            ->set('comment_id', $this->comment->id)
            ->set('user_id', $this->comment->user_id)
            ->set('current_user_id', $current_user_id);

        return $view;
    }
}