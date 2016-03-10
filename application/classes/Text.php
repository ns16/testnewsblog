<?php defined('SYSPATH') OR die('No direct script access.');

class Text extends Kohana_Text {

    /**
     * Wrap each line in the <p> tag.
     *
     * @param   string  $content  text string
     * @return  mixed
     */
    public static function wrap_in_p($content)
    {
        return preg_replace("/(.+)/", "<p>$1</p>", preg_replace("/\n+/", "\n", $content));
    }
}
