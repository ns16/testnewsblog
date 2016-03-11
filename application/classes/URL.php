<?php defined('SYSPATH') OR die('No direct script access.');

class URL extends Kohana_URL {

    public static function get_user_default_url($controller = '', $action = '', $id = NULL)
    {
        return Route::url('user_default',
            array(
                'directory'  => 'user',
                'controller' => $controller,
                'action'     => $action,
                'id'	     => $id,
            )
        );
    }

    public static function get_default_url($controller = '', $action = '', $id = NULL)
    {
        return Route::url('default',
            array(
                'controller' => $controller,
                'action'     => $action,
                'id'	     => $id,
            )
        );
    }

    public static function get_current_url()
    {
        return URL::base(TRUE).Request::current()->uri();
    }
}