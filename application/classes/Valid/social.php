<?php defined('SYSPATH') OR die('No direct script access.');

class Valid_Social extends Valid
{
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