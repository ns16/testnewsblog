<?php defined('SYSPATH') or die('No direct script access.');

class Widget_Favorite extends Widget {

    /**
     * @var  Model_Article|NULL  current article
     */
    protected $article = NULL;

    public function run()
    {
        $view = View::factory('widget/favorite');

        // Get id of article
        $article_id = $this->article->id;

        // Get id of current user
        $current_user_id = isset($this->user) ? $this->user->id : NULL;

        // Get ids of users
        $user_ids = Model_User::get_user_ids($article_id);

        // Set variable of view
        $view->set(array(
            'article_id'      => $article_id,
            'current_user_id' => $current_user_id,
            'user_ids'        => $user_ids,
        ));

        return $view;
    }
}