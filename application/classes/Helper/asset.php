<?php defined('SYSPATH') OR die('No direct script access.');

class Helper_Asset
{
	const TYPE_JS  = 'js';
	const TYPE_CSS = 'css';

	protected static $_instance = NULL;

	protected $_container = array(
		self::TYPE_JS  => array(),
		self::TYPE_CSS => array()
	);

	public static function init()
	{
		if ( ! isset(static::$_instance))
		{
			$class_name = get_called_class();
			static::$_instance = new $class_name();
		}

		return static::$_instance;
	}

	public static function generate_js()
	{
		$self = static::init();

		foreach(array_unique($self->_container['js']) as $path)
		{
			echo HTML::script($path);
		}
	}

	public static function generate_css()
	{
		$self = static::init();

		foreach(array_unique($self->_container['css']) as $path)
		{
			echo HTML::style($path);
		}
	}

	public static function require_js($path)
	{
		static::init()->require_by_type(self::TYPE_JS, $path);
	}

	public static function require_css($path)
	{
		static::init()->require_by_type(self::TYPE_CSS, $path);
	}

	protected function require_by_type($type, $path)
	{
		$this->_container[$type][] = $path;
	}

	protected function __construct() {}
}
