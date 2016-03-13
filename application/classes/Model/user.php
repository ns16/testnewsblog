<?php defined('SYSPATH') OR die('No direct script access.');

class Model_User extends Model_Auth_User {

    /**
     * Password validation for plain passwords.
     * In this version, the minimum length of the password is changed from 8 to 3.
     *
     * @param array $values
     * @return Validation
     */
    public static function get_password_validation($values)
    {
        return Validation::factory($values)
            ->rule('password', 'min_length', array(':value', 3))
            ->rule('password_confirm', 'matches', array(':validation', ':field', 'password'));
    }

    /**
     * @var string table name
     */
    protected $_table_name = 'users';

    /**
     * A user has one settings
     *
     * @var array Relationhips
     */
    protected $_has_one = array(
		'user_personal' => array(
			'model' => 'User_Personal',
			'foreign_key' => 'user_id',
		),
        'user_social' => array(
            'model' => 'User_Social',
            'foreign_key' => 'user_id',
        ),
	);

    /**
     * A user has many articles, tokens and roles
     *
     * @var array Relationhips
     */
    protected $_has_many = array(
        'favorites' => array(
            'model' => 'Article',
            'through' => 'users_favorites',
        ),
        'user_tokens' => array(
            'model' => 'User_Token',
        ),
        'roles' => array(
            'model' => 'Role',
            'through' => 'roles_users',
        ),
    );

    public function rules()
    {
        return array(
            'username' => array(
                array('not_empty'),
                array('max_length', array(':value', 32)),
                array(array($this, 'unique'), array('username', ':value')),
            ),
            'password' => array(
                array('not_empty'),
            ),
            'email' => array(
                array('not_empty'),
                array('email'),
                array('max_length', array(':value', 254)),
                array(array($this, 'unique'), array('email', ':value')),
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