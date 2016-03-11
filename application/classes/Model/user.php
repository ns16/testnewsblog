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
            //->rule('password', 'min_length', array(':value', 8))
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
			'model' => 'user_personal',
			'foreign_key' => 'user_id',
		),
        'user_social' => array(
            'model' => 'user_social',
            'foreign_key' => 'user_id',
        ),
	);

    /**
     * A user has many articles, tokens and roles
     *
     * @var array Relationhips
     */
    protected $_has_many = array(
        'article' => array(
            'model' => 'article',
            'through' => 'users_articles',
        ),
        'user_tokens' => array(
            'model' => 'User_Token',
        ),
        'roles' => array(
            'model' => 'Role',
            'through' => 'roles_users',
        ),
    );
}