<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Votes extends Controller {

    const VOTE_UP   = 1;
    const VOTE_DOWN = -1;

    public function action_up()
    {
        $this->set_vote(self::VOTE_UP);
    }

    public function action_down()
    {
        $this->set_vote(self::VOTE_DOWN);
    }

    protected function set_vote($value)
    {
        // Get id of current user
        $current_user = Auth::instance()->get_user();
        $current_user_id = $current_user ? $current_user->id : NULL;

        // Get id of article
        $article_id = $this->request->query('article_id');

        if ( ! $current_user_id)
        {
            $this->redirect('articles/'.$article_id);
        }

        // Get id of comment
        $comment_id = $this->request->query('comment_id');
        // Get id of user
        $user_id = $this->request->query('user_id');

        // Check that current user already voted to this comment or is author of
        // this comment
        if (Model_Article_Comment_Vote::is_author_comment($current_user_id, $user_id) || Model_Article_Comment_Vote::already_voted($comment_id, $current_user_id))
        {
            $this->redirect('articles/'.$article_id);
        }

        $model = ORM::factory('article_comment_vote');

        $model
            ->values(array(
                'comment_id' => $comment_id,
                'user_id'    => $current_user_id,
                'value'      => $value,
            ))
            ->create();

        $this->redirect('articles/'.$article_id);
    }

} // End Votes