<?php defined('SYSPATH') OR die('No direct script access.');

class Controller_Body extends Controller_Template {

    /**
     * @var  Model_User|NULL  user model
     */
    protected $user = NULL;

    /**
     * @var  View  page template
     */
    public $body;

    public function before()
    {
        parent::before();

        $this->user = Auth::instance()->get_user();

        $this->body = View::factory('body');

        $links = array(
            'media/css/style.css',
        );

        $this->template->title = 'Главная страница';
        $this->template->links = $links;
        $this->template->body = $this->body;
    }

} // End Body
