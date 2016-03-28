<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Comments extends Controller_Ajax {

    protected $current_user_id = NULL;
    protected $article_id      = NULL;
    protected $content         = NULL;

    protected $message         = NULL;
    protected $username        = NULL;
    protected $date            = NULL;
    protected $widget          = NULL;

    public function action_form()
    {
        // Get value of POST array
        $post = $this->request->post();

        // Get id of current user
        $current_user = Auth::instance()->get_user();
        $this->current_user_id = isset($current_user) ? $current_user->id : NULL;

        // Get id of article and content of comment
        $this->article_id = Arr::get($post, 'article_id');
        $this->content = Arr::get($post, 'content');

        // Check that article_id isn't exists
        if ( ! $this->article_id)
        {
            throw new HTTP_Exception_404;
        }

        // If user isn't logged
        if ( ! $this->current_user_id)
        {
            $this->message = 'Авторизуйтесь или зарегистрируйтесь, чтобы оставить комментарий!';
            $this->set_answer();
            return;
        }

        // If content of comment is empty
        if ( ! $this->content)
        {
            $this->message = 'Сначала введите комментарий!';
            $this->set_answer();
            return;
        }

        // Add comment into table
        $comment = ORM::factory('article_comment')
            ->values(array(
                'article_id' => $this->article_id,
                'user_id'    => $this->current_user_id,
                'content'    => $this->content,
            ))
            ->save();

        $this->username = $comment->user->username;
        $this->date = Date::rus_date_format(time());
        $this->widget = Widget::factory('votes', array('comment' => $comment));

//        var_dump($comment);
//        var_dump($this->username);
//        var_dump($this->date);
//        var_dump($this->widget);

//        echo $this->widget;

        $this->set_answer();

//        // Check that HTTP method is POST
//        if (Request::POST == $this->request->method())
//        {
//            // Get values from POST array
//            $post = $this->request->post();
//
//            // Get logged user
//            $user = Auth::instance()->get_user();
//
//            // Check that user isn't defined
//            if ( ! $user)
//            {
//                throw new HTTP_Exception_404;
//            }
//
//            // Add comment into table
//            ORM::factory('article_comment')
//                ->values(array(
//                    'article_id' => $article_id,
//                    'user_id'    => $user->id,
//                    'content'    => $post['content'],
//                ))
//                ->save();
//
//            // Redirect to page of view article with given id
//            $this->redirect(URL::get_default_url(
//                'articles',
//                '',
//                $article_id
//            ));
//        }
    }

    protected function set_answer()
    {
        $this->answer = array(
            'message'   => $this->message,
            'username'  => $this->username,
            'date'      => $this->date,
            'widget'    => $this->widget,
        );
    }

    public function action_delete()
    {
        // Get id of comment
        $comment_id = $this->request->query('comment_id');
        // Get id of user
        $user_id = $this->request->query('user_id');

        // Delete comment from table
        ORM::factory('article_comment', $comment_id)->delete();

        // Redirect to page of personal data
        $this->redirect(URL::get_user_default_url(
            'profile',
            'index',
            $user_id
        ));
    }

} // End Comments