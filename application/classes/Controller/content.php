<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Content extends Controller_Container {

    /**
     * @var  View  page template
     */
    public $content;

    public function before()
    {
        parent::before();

        $this->content = View::factory('content');

        $this->container->content = $this->content;
    }

} // End Content