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
     * Create a new user
     *
     * Example usage:
     * ~~~
     * $user = ORM::factory('User')->create_user($_POST, array(
     *	'username',
     *	'password',
     *	'email',
     * );
     * ~~~
     *
     * @param array $values
     * @param array $expected
     * @throws ORM_Validation_Exception
     */
    public function create_user($values, $expected)
    {
        // Validation for passwords
        $extra_validation = Model_User::get_password_validation($values)
            ->rule('password', 'not_empty');

        return $this->values($values, $expected)->create($extra_validation);
    }

    /**
     * Update an existing user
     *
     * [!!] We make the assumption that if a user does not supply a password, that they do not wish to update their password.
     *
     * Example usage:
     * ~~~
     * $user = ORM::factory('User')
     *	->where('username', '=', 'kiall')
     *	->find()
     *	->update_user($_POST, array(
     *		'username',
     *		'password',
     *		'email',
     *	);
     * ~~~
     *
     * @param array $values
     * @param array $expected
     * @throws ORM_Validation_Exception
     */
    public function update_user($values, $expected = NULL)
    {
        if (empty($values['password']))
        {
            unset($values['password'], $values['password_confirm']);
        }

        // Validation for passwords
        $extra_validation = Model_User::get_password_validation($values);

        return $this->values($values, $expected)->update($extra_validation);
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
            'through' => 'user_articles',
        ),
        'comments' => array(
            'model' => 'Article_Comment',
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

    /**
     * Данный метод возвращает идентификаторы тех пользователей, которые добавили
     * статью с даннным идентификатором в избранное
     *
     * @param   integer  $article_id  id of article
     * @return  array
     */
    public static function get_user_ids($article_id)
    {
        $users = ORM::factory('article', $article_id)->users->find_all()->as_array();

        $user_ids = array();

        foreach ($users as $user) {
            $user_ids[] = $user->id;
        }

        return $user_ids;
    }
}