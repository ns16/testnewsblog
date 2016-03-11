<?php defined('SYSPATH') OR die('No direct script access.');

class Valid extends Kohana_Valid {

    /**
     * Check that value is right answer
     *
     * @param   string  $value  captcha value
     * @return  bool
     */
    public static function captcha($value)
    {
        return $value == Session::instance()->get('answer');
    }

    /**
     * Check that value is allowable social network address
     *
     * @param   string  $value  social network address
     * @param   string  $field  social network name
     * @return  bool
     * @throws  HTTP_Exception_404
     */
    public static function profile($value, $field)
    {
        if ( ! method_exists('Valid_Social', $field))
        {
            throw new HTTP_Exception_404;
        }

        return Valid_Social::$field($value);
    }
}