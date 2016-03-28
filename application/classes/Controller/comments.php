<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Comments extends Controller_Ajax {

    public function action_form()
    {
        // Get value of POST array
        $post = $this->request->post();

        // Get id of current user
        $user = Auth::instance()->get_user();
        $user_id = isset($user) ? $user->id : NULL;

        // Get id of article and content of comment
        $article_id = Arr::get($post, 'article_id');
        $content = Arr::get($post, 'content');

        // Check that article_id isn't exists
        if ( ! $article_id)
        {
            throw new HTTP_Exception_404;
        }

        // If content of comment is empty
        if ( ! $content)
        {
            $this->answer(array(
                'error' => 'Сначала введите комментарий!',
            ));
            return;
        }

        // Add comment into table
        $comment = ORM::factory('article_comment')
            ->values(array(
                'article_id' => $article_id,
                'user_id'    => $user_id,
                'content'    => $content,
            ))
            ->save()->reload();

        $view = (string) View::factory('widget/comments/_comment')->set('comment', $comment);

        $this->answer(array(
            'body'   => $view,
            'status' => 1,
        ));
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