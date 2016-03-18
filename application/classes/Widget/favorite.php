<?php defined('SYSPATH') or die('No direct script access.');

class Widget_Favorite extends Widget {

    /**
     * @var  Model_Article|NULL  model of current article
     */
    protected $article = NULL;

    public function run()
    {
        $view = View::factory('widget/favorite');

        // Get users that have this article as favorite
        $users = $this->article->users
            ->find_all()
            ->as_array();

        // Get ids of users
        $user_ids = $this->get_user_ids($users);

        // Set variable of view
        $view->set(array(
            'article_id'      => $this->article->id,
            'current_user_id' => $this->user ? $this->user->id : NULL,
            'user_ids'        => $user_ids,
        ));

        return $view;
    }

    protected function get_user_ids($users)
    {
        $user_ids = array();

        foreach ($users as $user) {
            $user_ids[] = $user->id;
        }

        return $user_ids;
    }
}