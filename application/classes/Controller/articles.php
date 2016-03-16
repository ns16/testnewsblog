<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Articles extends Controller_Content {

    public function action_index()
    {
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

//        $favorite = Request::factory('articles/favorite')->execute();

        $view->set(array(
            'article'  => $article,
//            'favorite' => $favorite,
        ));

        $this->content->article = $view;
    }

    public function action_favorite()
    {
        $view = View::factory('articles/favorite');

        // Get model of article
//        $article = ORM::factory('article');

        $this->response->body($view);
    }

} // End Articles