<?php defined('SYSPATH') or die('No direct script access.');

class Widget_Header_Dropdown extends Widget {

    public function run()
    {
        $view = View::factory('widget/header/dropdown');

        $user = Auth::instance()->get_user();
        $view->set('user', $user);

        return $view;
    }
}