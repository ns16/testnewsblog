<?php defined('SYSPATH') or die('No direct script access.');

class Widget_Header_Dropdown extends Widget {

    public function run()
    {
        $view = View::factory('widget/header/dropdown');

        $view->set('user', $this->user);

        return $view;
    }
}