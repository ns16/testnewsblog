<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Votes extends Controller {

    protected $current_user_id = NULL;
    protected $comment_id      = NULL;
    protected $user_id         = NULL;
    protected $vote            = NULL;

    protected $message         = NULL;
    protected $sum_votes       = NULL;

    public function action_index()
    {
        $post = $this->request->post();

        $current_user = Auth::instance()->get_user();
        $this->current_user_id = isset($current_user) ? $current_user->id : NULL;

        $this->comment_id = Arr::get($post, 'comment_id');
        $this->user_id = Arr::get($post, 'user_id');
        $this->vote = Arr::get($post, 'vote');

        // If user isn't logged
        if ( ! $this->current_user_id)
        {
            $this->message = 'Авторизуйтесь или зарегистрируйтесь, чтобы проголосовать!';
            $this->send_json();
            return;
        }

        // Check that current user already voted to this comment or he is author
        // of this comment
        if ($this->ban_vote())
        {
            $this->message = 'Вы уже голосовали за данный комментарий!';
            $this->send_json();
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

        $comment = ORM::factory('article_comment', $this->comment_id);
        $this->sum_votes = $comment->votes->get_sum_votes_comment();

        $this->send_json();
    }

    protected function send_json()
    {
        $answer = array(
            'message'   => $this->message,
            'sum_votes' => $this->sum_votes,
        );

        echo json_encode($answer);
    }

    /**
     * Данный метод возвращает TRUE, если нужно запретить текущему пользователю
     * голосовать за данный комментарий, иначе возвращает FALSE
     *
     * @return bool
     */
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