<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Articles extends Controller_Content {

    public $article_id;

    public function before()
    {
        parent::before();

        $styles = array(
            'media/css/style.css',
            'media/css/article.css',
        );

        $this->template->styles = $styles;
    }

    public function action_view()
    {
        $view = View::factory('articles/view');

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

            // Set article_id variable
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