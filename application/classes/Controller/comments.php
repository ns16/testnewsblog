<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Comments extends Controller {

    public function action_index()
    {
        $view = View::factory('comments/index');

        // Get id of article
        $article_id = $this->request->param('id');

        // Check that article_id isn't exists
        if ( ! $article_id)
        {
            throw new HTTP_Exception_404;
        }

        // Get all comments for article with given id
        $comments = ORM::factory('article_comment')
            ->where('article_id', '=', $article_id)
            ->find_all();

        // Transfer comments into view
        $view->set('comments', $comments);

        $this->response->body($view);
    }

    public function action_form()
    {
        $view = View::factory('comments/form');

        // Get id of article
        $article_id = $this->request->param('id');

        // Check that article_id isn't exists
        if ( ! $article_id)
        {
            throw new HTTP_Exception_404;
        }

        // Check that HTTP method is POST
        if (HTTP_Request::POST == $this->request->method())
        {
            $post = $this->request->post();

            $user = Auth::instance()->get_user();

            // Check that user isn't defined
            if ( ! $user)
            {
                throw new HTTP_Exception_404;
            }

            // Add comment into table
            $comment = ORM::factory('article_comment')
                ->values(array(
                    'article_id' => $article_id,
                    'user_id'    => $user->id,
                    'content'    => $post['comment'],
                ))
                ->create();

            $this->redirect('articles/'.$article_id);
        }

        // Transfer article id into view
        $view->set('article_id', $article_id);

        $this->response->body($view);
    }

} // End Comments