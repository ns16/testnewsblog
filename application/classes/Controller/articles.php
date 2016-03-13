<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Articles extends Controller_Content {

    public function action_index()
    {
        $article = ORM::factory('article', 1);
        $comments = $article->comments;
        $users = $article->users;

        var_dump($article->as_array());
        var_dump($comments);
        var_dump($users);

//        $comment = ORM::factory('article_comment', 1);
//        $article = $comment->article;
//        $user = $comment->user;
//        $votes = $comment->votes;//НЕ РАБОТАЕТ!!!
//
//        var_dump($comment->as_array());
//        var_dump($article->as_array());
//        var_dump($user->as_array());
//        var_dump($votes->as_array());

        exit;

        $view = View::factory('articles/index');

        // Get id of article
        $this->article_id = $this->request->param('id');

        // Get model of article
        $article = ORM::factory('article');

        // Check that id isn't exists
        if ( ! $this->article_id)
        {
            // Get article with largest id
            $article
                ->order_by('id', 'DESC')
                ->find();

            $this->article_id = $article->id;
        }
        else
        {
            // Get article with given id
            $article
                ->where('id', '=', $this->article_id)
                ->find();
        }

        $view->set('article', $article);

        $this->content->article = $view;
    }

} // End Articles