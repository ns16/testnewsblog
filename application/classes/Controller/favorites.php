<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Favorites extends Controller
{
    protected $user_id    = NULL;
    protected $article_id = NULL;

    public function action_index()
    {
        $this->action();

        $this->redirect(URL::get_default_url(
            'articles',
            '',
            $this->article_id
        ));
    }

    protected function action()
    {
        // Get id of article
        $this->article_id = $this->request->param('id');

        // Get id of user
        $this->user_id = Auth::instance()->get_user()->id;

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