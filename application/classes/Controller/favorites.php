<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Favorites extends Controller_Ajax {

    public function action_index()
    {
        // Get value of POST array
        $post = $this->request->post();

        // Get id of current user
        $current_user = Auth::instance()->get_user();
        $current_user_id = isset($current_user) ? $current_user->id : NULL;

        // Get id of article
        $article_id = Arr::get($post, 'article_id');

        // If id of article isn't defind or article with given id isn't exist
        if ( ! $article_id OR ! Model_Article::article_exists($article_id))
        {
            throw new HTTP_Exception_404;
        }

        // If user isn't logged
        if ( ! $current_user_id)
        {
            $this->answer(array(
                'error' => 'Авторизуйтесь или зарегистрируйтесь, чтобы добавить статью в избранное!',
            ));
            return;
        }

        // Get model of link of user and article with given id
        $model = ORM::factory('User_Article')
            ->where('user_id', '=', $current_user_id)
            ->where('article_id', '=', $article_id)
            ->find();

        if ($model->loaded())
        {
            // If model is loaded, then delete record from table
            $model->delete();

            $message = 'Статья удалена из избранного';
        }
        else
        {
            // If model isn't loaded, then add record into table
            $model
                ->values(array(
                    'user_id'    => $current_user_id,
                    'article_id' => $article_id,
                ))
                ->save();

            $message = 'Статья добавлена в избранное';
        }

        // Get ids of users
        $user_ids = Model_User::get_user_ids($article_id);

        // Get view of icon
        $view = (string) View::factory('widget/favorite/_icon')
            ->set(array(
                'current_user_id' => $current_user_id,
                'user_ids'        => $user_ids
            ));

        $this->answer(array(
            'status'  => 1,
            'message' => $message,
            'body'    => $view,
        ));
    }

} // End Favorites