<?php defined('SYSPATH') OR die('No direct script access.');

class Valid extends Kohana_Valid {

    /**
     * Check that captcha entered correct
     *
     * @param   string  $value  captcha value
     * @return  bool
     */
    public static function captcha($value)
    {
        return $value == Session::instance()->get('answer');
    }

    protected static function profile($value, $domain, $prefix = NULL)
    {
        return preg_match('/^http[s]?\:\/\/'.$prefix.$domain.'\/[\w]+$/', $value);
    }
}