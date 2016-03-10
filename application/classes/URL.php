<?php defined('SYSPATH') OR die('No direct script access.');

class URL extends Kohana_URL {

    public static function get_current_url()
    {
        return URL::base(TRUE).Request::current()->uri();
    }
}