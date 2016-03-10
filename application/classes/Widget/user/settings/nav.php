<?php defined('SYSPATH') or die('No direct script access.');

class Widget_User_Settings_Nav extends Widget {

    /**
     * @var  string|NULL  user id
     */
    protected $user_id = NULL;

    public function run()
    {
        $view = View::factory('widget/user/settings/nav');

        $config = Kohana::$config->load('user/settings/nav');

        $items = $config->as_array();
        $items = str_replace('{user_id}', $this->user_id, $items);

        $current_url = URL::get_current_url();

        $view
            ->set('items', $items)
            ->set('current_url', $current_url);

        return $view;
    }
}