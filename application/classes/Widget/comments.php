<?php defined('SYSPATH') or die('No direct script access.');

class Widget_Comments extends Widget {

    /**
     * @var  Model_Article|NULL  current article
     */
    protected $article = NULL;

    public function run()
    {
        $view = View::factory('widget/comments');

        $comments = $this->article->comments->find_all();

        $view->set(array(
            'comments' => $comments,
            'article'  => $this->article,
        ));

        return $view;
    }
}