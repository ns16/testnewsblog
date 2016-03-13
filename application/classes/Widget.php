<?php defined('SYSPATH') or die('No direct script access.');

abstract class Widget {

    /**
     * @var  string  widget prefix
     */
    protected static $prefix = 'Widget';

    /**
     * @var  Model_User|NULL  user model
     */
    protected $user = NULL;

    public static function factory($name, array $params = array())
    {
        $widget_name = static::$prefix . '_' . Text::ucfirst($name, '_');
        $widget = new $widget_name($params);

        $widget->user = Auth::instance()->get_user();

        return $widget->run();
    }

    protected function __construct(array $params = array())
    {
        foreach($params as $param => $value)
        {
            $this->{$param} = $value;
        }
    }

    abstract public function run();
}