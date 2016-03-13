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
    // has one - имеет один
    // Пользователь может иметь только одну группу личных данных, а личные данные
    // могут принадлежать только одному пользователю
    // Пользователь может иметь только одну группу данных социальных сетей, а
    // данные социальных сетей могут принадлежать только одному пользователю
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
    // has many - имеет много
    // Пользователь может иметь много избранных статей, а избранная статья может
    // принадлежать многим пользователям
    // Пользователь может иметь много комментариев, но комментарий принадлежит
    // только одному пользователю
    // Пользователь может иметь много голосов, но голос принадлежит только одному
    // пользователю
    protected $_has_many = array(
        'articles' => array(
            'model' => 'Article',
            'through' => 'users_articles',
        ),
        'comments' => array(
            'model' => 'Article_comment',
            'foreign_key' => 'user_id',
        ),
        'votes' => array(
            'model' => 'Article_Comment_Vote',
            'foreign_key' => 'user_id',
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