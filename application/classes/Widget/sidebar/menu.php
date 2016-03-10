<?php defined('SYSPATH') or die('No direct script access.');

class Widget_Sidebar_Menu extends Widget {

    public function run()
    {
        $view = View::factory('widget/sidebar/menu');

        $articles = ORM::factory('article')
            ->find_all();

        $view->set('articles', $articles);

        return $view;
    }
}