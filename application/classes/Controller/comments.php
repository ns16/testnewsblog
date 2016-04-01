<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Comments extends Controller_Ajax {

    public function action_form()
    {
        // Get value of POST array
        $post = $this->request->post();

        // Get id of current user
        $current_user = Auth::instance()->get_user();
        $current_user_id = isset($current_user) ? $current_user->id : NULL;

        // Get id of article and content of comment. Convert special characters in
        // HTML-entities
        $article_id = Arr::get($post, 'article_id');
        $content = HTML::chars(Arr::get($post, 'content'));

        // If id of article isn't defind or article with given id isn't exist
        if ( ! $article_id OR ! $this->article_exists($article_id))
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
                'user_id'    => $current_user_id,
                'content'    => $content,
            ))
            ->save()->reload();

        // Get view of added comment
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

    /**
     * Данный метод проверяет, существует ли статья с данным идентификатором
     *
     * @param   integer  $article_id  id of article
     * @return  bool
     */
    public static function article_exists($article_id)
    {
        return ORM::factory('article', $article_id)->loaded();
    }

} // End Comments