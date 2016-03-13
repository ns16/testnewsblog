<?php defined('SYSPATH') OR die('No direct script access.');

class Model_Article extends ORM {

    protected $_table_name = 'articles';

    // has many -
    protected $_has_many = array(
        'user' => array(
            'model' => 'User',
            'through' => 'users_favorites',
        )
    );
}