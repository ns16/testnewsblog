<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Votes extends Controller {

    const VOTE_UP   = 1;
    const VOTE_DOWN = -1;

    protected $current_user_id = NULL;
    protected $comment_id      = NULL;
    protected $user_id         = NULL;

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
        $this->current_user_id = isset($current_user) ? $current_user->id : NULL;

        // Get id of article
        $article_id = $this->request->query('article_id');

        // If user isn't logged, then reload page
        if ( ! $this->current_user_id)
        {
            $this->redirect(URL::get_default_url(
                'articles',
                '',
                $article_id
            ));
        }

        // Get id of comment
        $this->comment_id = $this->request->query('comment_id');
        // Get id of user
        $this->user_id = $this->request->query('user_id');

        // Check that current user already voted to this comment or he is author
        // of this comment
        if ($this->ban_vote())
        {
            $this->redirect(URL::get_default_url(
                'articles',
                '',
                $article_id
            ));
        }

        ORM::factory('article_comment_vote')
            ->values(array(
                'user_id'    => $this->current_user_id,
                'comment_id' => $this->comment_id,
                'value'      => $value,
            ))
            ->save();

        $this->redirect(URL::get_default_url(
            'articles',
            '',
            $article_id
        ));
    }

    protected function ban_vote()
    {
        return $this->is_author_comment() OR $this->already_voted();
    }

    /**
     * Данный метод проверяет, является ли текущий пользователь автором данного
     * комментария
     *
     * @return bool
     */
    protected function is_author_comment()
    {
        return $this->current_user_id == $this->user_id;
    }

    /**
     * Данный метод проверяет, голосовал ли текущий пользователь за данный
     * комментарий
     *
     * @return bool
     */
    protected function already_voted()
    {
        $model = ORM::factory('article_comment_vote', array(
            'user_id'    => $this->current_user_id,
            'comment_id' => $this->comment_id,
        ));

        return $model->loaded();
    }

} // End Votes