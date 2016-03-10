<?php defined('SYSPATH') OR die('No direct script access.');

class Model_Article extends ORM {

    protected $_table_name = 'articles';

    protected $_has_many = array(
        'user' => array(
            'model' => 'user',
            'through' => 'users_articles',
        )
    );
}