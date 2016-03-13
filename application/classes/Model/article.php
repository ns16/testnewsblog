<?php defined('SYSPATH') OR die('No direct script access.');

class Model_Article extends ORM {

    protected $_table_name = 'articles';

    // has many - имеет много
    // Статья может иметь много комментариев, но комментарий принадлежит
    // только одной статье
    // Статья может быть избранной для многих пользователей, и пользователь может
    // иметь много избранных статей
    protected $_has_many = array(
        // НЕ РАБОТАЕТ!!!
        'comments' => array(
            'model' => 'Article_Comment',
            'foreign_key' => 'article_id',
        ),
        'users' => array(
            'model' => 'User',
            'through' => 'users_favorites',
        ),
    );
}