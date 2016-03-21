<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Favorites extends Controller
{
    protected $user_id    = NULL;
    protected $article_id = NULL;

    /**
     * Данный экшен после добавления статьи в избранное или удаления ее из
     * избранного перенаправляет пользователя на страницу просмотра статьи с данным
     * идентификатором
     */
    public function action_index()
    {
        $this->toggle();

        $this->redirect(URL::get_default_url(
            'articles',
            '',
            $this->article_id
        ));
    }

    /**
     * Данный метод добавляет статью в избранное, если она еще не добавлена, и
     * удаляет ее из избранного, если она уже добавлена
     *
     * @throws Kohana_Exception
     */
    protected function toggle()
    {
        // Get id of current user
        $user = Auth::instance()->get_user();
        $this->user_id = isset($user) ? $user->id : NULL;

        // Get id of article
        $this->article_id = $this->request->param('id');

        // If user isn't logged, then reload page
        if ( ! $this->user_id)
        {
            $this->redirect(URL::get_default_url(
                'articles',
                '',
                $this->article_id
            ));
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
        }
    }

} // End Favorites