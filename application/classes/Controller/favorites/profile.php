<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Favorites_Profile extends Controller_Favorites
{
    public function action_index()
    {
        $this->action();

        $this->redirect(URL::get_user_default_url(
            'profile',
            'index',
            $this->user_id
        ));
    }

} // End Favorites_Profile