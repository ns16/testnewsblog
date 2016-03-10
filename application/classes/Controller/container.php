<?php defined('SYSPATH') OR die('No direct script access.');

class Controller_Container extends Controller_Body {

    /**
     * @var  View  page template
     */
    public $container;

    public function before()
    {
        parent::before();

        $this->container = View::factory('container');

        $this->body->container = $this->container;
    }

} // End Container
