<?php defined('SYSPATH') OR die('No direct script access.');

class Model_User_Personal extends ORM {

    const MALE   = 1;
    const FEMALE = 2;

    protected $_table_name  = 'user_personal';
    protected $_primary_key = 'user_id';

    public function rules()
    {
        return array(
            'name' => array(
                array('max_length', array(':value', 50)),
            ),
            'birthdate' => array(
                array('date'),
            ),
            'sex' => array(
                array('regex', array(':value', '/^[012]$/')),
            ),
            'city' => array(
                array('max_length', array(':value', 50)),
            ),
            'activity' => array(
                array('max_length', array(':value', 255)),
            ),
        );
    }

    public function filters()
    {
        return array(
            'name' => array(
                array('trim'),
                array('strip_tags'),
            ),
            'birthdate' => array(
                array('trim'),
                array('strip_tags'),
            ),
            'sex' => array(
                array('trim'),
                array('strip_tags'),
            ),
            'city' => array(
                array('trim'),
                array('strip_tags'),
            ),
            'activity' => array(
                array('trim'),
                array('strip_tags'),
            ),
            'about_me' => array(
                array('trim'),
                array('strip_tags'),
            ),
        );
    }

    public function labels()
    {
        return array(
            'user_id'   => 'Пользователь',
            'name'      => 'Имя пользователя',
            'birthdate' => 'Дата рождения',
            'sex'       => 'Пол',
            'city'      => 'Город',
            'activity'  => 'Деятельность',
            'about_me'  => 'О себе',
        );
    }

    public static function get_sexes()
    {
        return array(
            self::MALE   => 'Мужской',
            self::FEMALE => 'Женский',
        );
    }
}