<?php defined('SYSPATH') or die('No direct script access.');

class Controller_User_Profile extends Controller_User_Base {

    public function before()
    {
        $this->user_id = $this->request->param('id');

        parent::before();

        $styles = array(
            'media/css/style.css',
            'media/css/profile.css',
        );

        $scripts = array(
            'media/js/profile.js',
        );

        $this->template->title = 'Мой профиль';
        $this->template->styles = $styles;
        $this->template->scripts = $scripts;
    }

    public function action_index()
    {
        $errors = array();

        $view = View::factory('user/profile');

        // Get model of user with given id
        $user = ORM::factory('User', $this->user_id);

        // Get personal data of user
        $personal_data = $user->user_personal->as_array();

        // Get sex of user as string
        $personal_data['sex'] = Model_User_Personal::get_sex_name($personal_data['sex']);

        // Replace keys of personal data array
        $labels = array_values($user->user_personal->labels());
        $personal_data = array_combine($labels, $personal_data);

        unset($personal_data['Идентификатор']);

        // Get account and social networks data of user
        $account_data = $user->as_array();
        $social_data = $user->user_social->as_array();

        unset($social_data['user_id']);

        // Get articles and comments
        $comments = $user->comments->find_all();
        $articles = $user->articles->find_all();

        // Get number of comments and favorite articles
        $comments_count = $comments->count();
        $articles_count = $articles->count();

        // Get number of votes
        $sum_votes = Model_Article_Comment_Vote::get_sum_votes_user($this->user_id);

        $view->set(array(
            'errors'         => $errors,
            'user_id'        => $this->user_id,
            'username'       => $user->username,
            'personal_data'  => $personal_data,
            'account_data'   => $account_data,
            'social_data'    => $social_data,
            'comments'       => $comments,
            'articles'       => $articles,
            'comments_count' => $comments_count,
            'articles_count' => $articles_count,
            'sum_votes'      => $sum_votes,
        ));

        $this->body->container = $view;
    }

} // End User_Profile