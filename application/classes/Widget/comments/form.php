<?php defined('SYSPATH') or die('No direct script access.');

class Widget_Comments_Form extends Widget {

    /**
     * @var  Model_Article|NULL  current article
     */
    protected $article = NULL;

    public function run()
    {
        $view = View::factory('widget/comments/form');

        $view->set('article_id', $this->article->id);

        return $view;
    }
}