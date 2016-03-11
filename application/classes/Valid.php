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


    public static function profile($value, $field)
    {
        if ( ! is_callable($field))
        {
            throw new HTTP_Exception_404;
        }

        return $field($value);
    }

    public static function profile_vk($value)
    {
        return (bool) preg_match('/^http[s]?\:\/\/vk\.com\/[\w]+$/', $value);
    }

    public static function profile_fb($value)
    {
        return (bool) preg_match('/^http[s]?\:\/\/(www\.)?facebook\.com\/[\w\.]+$/', $value);
    }

    public static function profile_gp($value)
    {
        return (bool) preg_match('/^http[s]?\:\/\/(plus\.)?google\.com\/[\w]+$/', $value);
    }

    public static function profile_tw($value)
    {
        return (bool) preg_match('/^http[s]?\:\/\/twitter\.com\/[\w]+$/', $value);
    }

    public static function profile_ok($value)
    {
        return (bool) preg_match('/^http[s]?\:\/\/ok\.ru\/[\w]+$/', $value);
    }
}