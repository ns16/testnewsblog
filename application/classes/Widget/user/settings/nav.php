<?php defined('SYSPATH') or die('No direct script access.');

class Widget_User_Settings_Nav extends Widget {

    public function run()
    {
        $view = View::factory('widget/user/settings/nav');

        $config = Kohana::$config->load('user/settings/nav');

        $items = $config->as_array();
        $items = str_replace('{user_id}', $this->user->id, $items);

        $current_url = URL::get_current_url();

        $view->set(array(
            'items'       => $items,
            'current_url' => $current_url,
        ));

        return $view;
    }
}