<?php defined('SYSPATH') OR die('No direct script access.');

class Model_Article extends ORM {

    protected $_table_name = 'articles';

    // has many - имеет много
    // Статья может иметь много комментариев, но комментарий принадлежит только
    // одной статье
    // Избранная статья может принадлежать многим пользователям, а пользователь
    // может иметь много избранных статей
    // Для получения пользователей нужно использовать find_all()
    protected $_has_many = array(
        'comments' => array(
            'model' => 'Article_Comment',
            'foreign_key' => 'article_id',
        ),
        'users' => array(
            'model' => 'User',
            'through' => 'user_articles',
        ),
    );

    /**
     * Данный метод проверяет, существует ли статья с данным идентификатором
     *
     * @param   integer  $id  id of article
     * @return  bool
     */
    public static function article_exists($article_id)
    {
        return ORM::factory('article', $article_id)->loaded();
    }
}