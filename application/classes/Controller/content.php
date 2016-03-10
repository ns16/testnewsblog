<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Content extends Controller_Container {

    /**
     * @var  View  page template
     */
    public $content;

    public $article_id;

    public function before()
    {
        parent::before();

        $this->content = View::factory('content');
    }

    public function after()
    {
        // Get template of comments
        $comments = Request::factory('comments/index/'.$this->article_id)
            ->execute();

        // Get template of form
        $form = Request::factory('comments/form/'.$this->article_id)
            ->execute();

        $this->content->comments = $comments;
        $this->content->form = $form;

        $this->container->content = $this->content;

        parent::after();
    }

} // End Content