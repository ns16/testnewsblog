<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Comments extends Controller {

    public function action_form()
    {
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
            // Get values from POST array
            $post = $this->request->post();

            // Get logged user
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
                ->save();

            // Redirect to page of personal data
            $this->redirect(URL::get_default_url('articles', '', $article_id));
        }
    }

} // End Comments