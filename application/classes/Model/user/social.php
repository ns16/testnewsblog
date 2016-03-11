<?php defined('SYSPATH') OR die('No direct script access.');

class Model_User_Social extends ORM {

    protected $_table_name  = 'user_social';
    protected $_primary_key = 'user_id';

    public function rules()
    {
        return array(
            TRUE => array(
                array('max_length', array(':value', 255)),
                array('Valid::profile', array(':value', ':field')),
            ),
        );
    }

    public function filters()
    {
        return array(
            TRUE => array(
                array('trim'),
                array('strip_tags'),
            ),
        );
    }

    public function labels()
    {
        return array(
            'profile_vk' => 'Вконтакте',
            'profile_fb' => 'Facebook',
            'profile_gp' => 'Google+',
            'profile_tw' => 'Twitter',
            'profile_ok' => 'Одноклассники',
        );
    }
}