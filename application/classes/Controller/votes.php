<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Votes extends Controller_Ajax {

    public function action_index()
    {
        // Get value of POST array
        $post = $this->request->post();

        // Get id of comment, id of user, who posted this comment, and value of vote
        $comment_id = Arr::get($post, 'comment_id');
        $user_id = Arr::get($post, 'user_id');
        $vote = Arr::get($post, 'vote');

        // If value of vote isn't valid or current user is author of this comment
        if ($this->vote_is_not_valid($vote) OR $this->user_is_author_of_comment($this->current_user_id, $user_id))
        {
            throw new HTTP_Exception_404;
        }

        // If user isn't logged
        if ( ! $this->current_user_id)
        {
            $this->answer(array(
                'error' => 'Авторизуйтесь или зарегистрируйтесь, чтобы проголосовать!',
            ));
            return;
        }

        // If current user already voted to this comment
        if ($this->user_already_voted($this->current_user_id, $comment_id))
        {
            $this->answer(array(
                'error' => 'Вы уже проголосовали за данный комментарий!',
            ));
            return;
        }

        // Add vote into table
        $vote = ORM::factory('article_comment_vote')
            ->values(array(
                'comment_id' => $comment_id,
                'user_id'    => $this->current_user_id,
                'value'      => $vote,
            ))
            ->save();

        // Get sum of votes of given comment
        $sum_votes = $vote->comment->votes->get_sum_votes_comment();

        // Get view of added comment
        $view = (string) View::factory('widget/votes/_sum')->set('sum_votes', $sum_votes);

        $this->answer(array(
            'status' => 1,
            'body'   => $view,
        ));
    }

    /**
     * Данный метод проверяет, является ли значение оставленного пользователем
     * голоса невалидным
     *
     * @param   integer  $vote  value of vote
     * @return  bool
     */
    protected function vote_is_not_valid($vote)
    {
        return $vote != Model_Article_Comment_Vote::VOTE_DOWN AND $vote != Model_Article_Comment_Vote::VOTE_UP;
    }

    /**
     * Данный метод проверяет, является ли текущий пользователь автором данного
     * комментария
     *
     * @param   integer  $current_user_id  id of current user
     * @param   integer  $user_id          id of user, who posted this comment
     * @return  bool
     */
    protected function user_is_author_of_comment($current_user_id, $user_id)
    {
        return $current_user_id == $user_id;
    }

    /**
     * Данный метод проверяет, голосовал ли текущий пользователь за данный
     * комментарий
     *
     * @param   integer  $current_user_id  id of current user
     * @param   integer  $comment_id       id of comment
     * @return  bool
     */
    protected function user_already_voted($current_user_id, $comment_id)
    {
        $model = ORM::factory('article_comment_vote', array(
            'user_id'    => $current_user_id,
            'comment_id' => $comment_id,
        ));

        return $model->loaded();
    }

} // End Votes