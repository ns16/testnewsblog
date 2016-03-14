<?php defined('SYSPATH') or die('No direct script access.');

class Widget_Votes extends Widget {

    /**
     * @var  Model_Article_Comment|NULL  comment to article
     */
    protected $comment = NULL;

    public function run()
    {
        $view = View::factory('widget/votes');

        $sum_votes = $this->comment->votes->get_sum_votes_comment();
        $current_user_id = isset($this->user) ? $this->user->id : NULL;

        $view->set(array(
            'sum_votes'       => $sum_votes,
            'current_user_id' => $current_user_id,
            'comment'         => $this->comment,
        ));

        return $view;
    }
}