<?php defined('SYSPATH') OR die('No direct script access.');

class Model_User_Account extends Model_User {

    public function rules()
    {
        return array(
            'username' => array(
                array('not_empty'),
                array('max_length', array(':value', 32)),
                array(array($this, 'unique'), array('username', ':value')),
            ),
            'email' => array(
                array('not_empty'),
                array('email'),
                array('max_length', array(':value', 254)),
                array(array($this, 'unique'), array('email', ':value')),
            ),
            'password' => array(
                array('matches', array(':validation', ':field', 'password_confirm')),
                array('min_length', array(':value', 3)),
                array('max_length', array(':value', 64)),
            ),
        );
    }

    public function filters()
    {
        return array(
            'password' => array(
                array(array(Auth::instance(), 'hash'))
            )
        );
    }

    public function labels()
    {
        return array(
            'username' => 'Имя пользователя',
            'email'    => 'E-mail',
            'password' => 'Пароль',
        );
    }
}