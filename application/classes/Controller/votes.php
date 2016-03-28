<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Votes extends Controller_Ajax {

    protected $current_user_id = NULL;
    protected $comment_id      = NULL;
    protected $user_id         = NULL;
    protected $vote            = NULL;

    protected $message         = NULL;
    protected $sum_votes       = NULL;

    public function action_index()
    {
        $post = $this->request->post();

        // Get id of current user
        $current_user = Auth::instance()->get_user();
        $this->current_user_id = isset($current_user) ? $current_user->id : NULL;

        // Get id of comment, id of user, who posted comment, and value of vote
        $this->comment_id = Arr::get($post, 'comment_id');
        $this->user_id = Arr::get($post, 'user_id');
        $this->vote = Arr::get($post, 'vote');

        // If value of vote isn't valid or current user is author of this comment
        if ($this->vote_is_not_valid() OR $this->is_author_of_comment())
        {
            throw new HTTP_Exception_404;
        }

        // If user isn't logged
        if ( ! $this->current_user_id)
        {
            $this->message = 'Авторизуйтесь или зарегистрируйтесь, чтобы проголосовать!';
            $this->set_answer();
            return;
        }

        // If current user already voted to this comment
        if ($this->already_voted())
        {
            $this->message = 'Вы уже проголосовали за данный комментарий!';
            $this->set_answer();
            return;
        }

        // Set values for fields
        ORM::factory('article_comment_vote')
            ->values(array(
                'comment_id' => $this->comment_id,
                'user_id'    => $this->current_user_id,
                'value'      => $this->vote,
            ))
            ->save();

        // Get sum of votes of given comment
        $comment = ORM::factory('article_comment', $this->comment_id);
        $this->sum_votes = $comment->votes->get_sum_votes_comment();

        $this->set_answer();
    }

    protected function set_answer()
    {
        $this->answer = array(
            'message'   => $this->message,
            'sum_votes' => $this->sum_votes,
        );
    }

    /**
     * Данный метод проверяет, является значение оставленного пользователем
     * голоса невалидным
     *
     * @return bool
     */
    protected function vote_is_not_valid()
    {
        return
            $this->vote != Model_Article_Comment_Vote::VOTE_DOWN
            AND $this->vote != Model_Article_Comment_Vote::VOTE_UP;
    }

    /**
     * Данный метод возвращает TRUE, если нужно запретить текущему пользователю
     * голосовать за данный комментарий, иначе возвращает FALSE
     *
     * @return bool
     */
    protected function ban_vote()
    {
        return $this->is_author_of_comment() OR $this->already_voted();
    }

    /**
     * Данный метод проверяет, является ли текущий пользователь автором данного
     * комментария
     *
     * @return bool
     */
    protected function is_author_of_comment()
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