<?php defined('SYSPATH') or die('No direct script access.');

class Controller_User_Base extends Controller_Body {

    /**
     * @var  string|NULL  user id
     */
    protected $user_id = NULL;

    public function before()
    {
        parent::before();

        // If user isn't logged or id of user not equals gotten id
        if ( ! $this->user OR $this->user->id !== $this->user_id)
        {
            throw new HTTP_Exception_404;
        }
    }

} // End User_Base