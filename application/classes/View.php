<?php defined('SYSPATH') OR die('No direct script access.');

class View extends Kohana_View {

    public function set($key, $value = NULL)
    {
        if (is_array($key))
        {
            return $this->set_array($key);
        }

        return parent::set($key, $value);
    }

    public function set_array(array $params = array())
    {
        foreach ($params as $key => $value)
        {
            parent::set($key, $value);
        }

        return $this;
    }
}
