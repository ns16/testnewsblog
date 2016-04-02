<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Comments extends Controller_Ajax {

    public function action_form()
    {
        // Get value of POST array
        $post = $this->request->post();

        // Get id of article and content of comment. Convert special characters in
        // HTML-entities
        $article_id = Arr::get($post, 'article_id');
        $content = HTML::chars(Arr::get($post, 'content'));

        // If id of article isn't defind or article with given id isn't exist
        if ( ! $article_id OR ! Model_Article::article_exists($article_id))
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
                'user_id'    => $this->current_user_id,
                'content'    => $content,
            ))
            ->save()->reload();

        // Get view of added comment
        $view = (string) View::factory('widget/comments/_comment')->set('comment', $comment);

        $this->answer(array(
            'status' => 1,
            'body'   => $view,
        ));
    }

    public function action_delete()
    {
        // Get value of POST array
        $post = $this->request->post();

        // Get id of article and content of comment. Convert special characters in
        // HTML-entities
        $comment_id = Arr::get($post, 'comment_id');

        // If id of comment isn't defind or comment with given id doesn't belong to
        // current user
        if ( ! $comment_id OR ! Model_Article_Comment::comment_belongs_to_user($comment_id, $this->current_user_id))
        {
            throw new HTTP_Exception_404;
        }

        // Delete comment from table
        ORM::factory('article_comment', $comment_id)->delete();

        $this->answer(array(
            'status' => 1,
        ));
    }

} // End Comments