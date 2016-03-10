<?php defined('SYSPATH') or die('No direct script access.');

class Controller_User_Profile extends Controller_User_Base {

    public function before()
    {
        $this->user_id = $this->request->param('id');

        parent::before();
    }

    public function action_index()
    {
        $errors = array();

        $view = View::factory('user/profile');

        $view
            ->set('errors', $errors)
            ->set('user_id', $this->user_id);

        $links = array(
            'media/css/style.css',
            'media/css/profile.css',
        );

        $this->template->title = 'Мой профиль';
        $this->template->links = $links;
        $this->body->container = $view;
    }

} // End User_Profile