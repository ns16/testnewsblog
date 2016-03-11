<?php defined('SYSPATH') OR die('No direct script access.');

class View extends Kohana_View {

    public function set(array $params = array())
    {
        foreach ($params as $key => $value)
        {
            parent::set($key, $value);
        }

        return $this;
    }
}
