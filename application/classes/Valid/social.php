<?php defined('SYSPATH') OR die('No direct script access.');

class Valid_Social extends Valid {

    public static function profile_vk($value)
    {
        return Valid::profile($value, 'vk\.com');
    }

    public static function profile_fb($value)
    {
        return Valid::profile($value, 'facebook\.com', '(www\.)?');
    }

    public static function profile_gp($value)
    {
        return Valid::profile($value, 'google\.com', '(plus\.)?');
    }

    public static function profile_tw($value)
    {
        return Valid::profile($value, 'twitter\.com');
    }

    public static function profile_ok($value)
    {
        return Valid::profile($value, 'ok\.ru');
    }
}