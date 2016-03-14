<?php defined('SYSPATH') OR die('No direct script access.');

class Model_User_Social extends ORM {

    protected $_table_name  = 'user_social';
    protected $_primary_key = 'user_id';

    public function rules()
    {
        return array(
            'profile_vk' => array(
                array('max_length', array(':value', 255)),
                array('Valid::profile', array(':value', ':field')),
            ),
            'profile_fb' => array(
                array('max_length', array(':value', 255)),
                array('Valid::profile', array(':value', ':field')),
            ),
            'profile_gp' => array(
                array('max_length', array(':value', 255)),
                array('Valid::profile', array(':value', ':field')),
            ),
            'profile_tw' => array(
                array('max_length', array(':value', 255)),
                array('Valid::profile', array(':value', ':field')),
            ),
            'profile_ok' => array(
                array('max_length', array(':value', 255)),
                array('Valid::profile', array(':value', ':field')),
            ),
        );
    }

    public function filters()
    {
        return array(
            'profile_vk' => array(
                array('trim'),
                array('strip_tags'),
            ),
            'profile_fb' => array(
                array('trim'),
                array('strip_tags'),
            ),
            'profile_gp' => array(
                array('trim'),
                array('strip_tags'),
            ),
            'profile_tw' => array(
                array('trim'),
                array('strip_tags'),
            ),
            'profile_ok' => array(
                array('trim'),
                array('strip_tags'),
            ),
        );
    }

    public function labels()
    {
        return array(
            'user_id'    => 'Идентификатор',
            'profile_vk' => 'Вконтакте',
            'profile_fb' => 'Facebook',
            'profile_gp' => 'Google+',
            'profile_tw' => 'Twitter',
            'profile_ok' => 'Одноклассники',
        );
    }
}