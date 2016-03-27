<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Favorites extends Controller {

    protected $article_id = NULL;
    protected $user_id    = NULL;

    protected $message    = NULL;
    protected $class      = NULL;

    /**
     * Данный экшен после добавления статьи в избранное или удаления ее из
     * избранного перенаправляет пользователя на страницу просмотра статьи с данным
     * идентификатором
     */
    public function action_index()
    {
        $post = $this->request->post();

        $this->article_id = Arr::get($post, 'article_id');

        $user = Auth::instance()->get_user();
        $this->user_id = isset($user) ? $user->id : NULL;

        $this->toggle();

        $answer = array(
            'message' => $this->message,
            'class'   => $this->class,
        );

        echo json_encode($answer);
    }

    /**
     * Данный метод добавляет статью в избранное, если она еще не добавлена, и
     * удаляет ее из избранного, если она уже добавлена
     *
     * @throws Kohana_Exception
     */
    protected function toggle()
    {
        // If user isn't logged, then reload page
        if ( ! $this->user_id)
        {
            $this->message = 'Авторизуйтесь или зарегистрируйтесь, чтобы добавить статью в избранное!';
            $this->class   = '';

            return;
        }

        // Get model of link of user and article with given ids
        $model = ORM::factory('User_Article')
            ->where('user_id', '=', $this->user_id)
            ->where('article_id', '=', $this->article_id)
            ->find();

        if ($model->loaded())
        {
            // If model is loaded, then delete record from table
            $model->delete();

            $this->message = 'Статья удалена из избранного';
            $this->class   = 'glyphicon-star glyphicon-star-empty';
        }
        else
        {
            // If model isn't loaded, then add record into table
            $model
                ->values(array(
                    'user_id'    => $this->user_id,
                    'article_id' => $this->article_id,
                ))
                ->save();

            $this->message = 'Статья добавлена в избранное';
            $this->class   = 'glyphicon-star glyphicon-star-empty';
        }
    }

} // End Favorites