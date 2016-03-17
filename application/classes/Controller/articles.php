<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Articles extends Controller_Content {

    public function action_view()
    {
        $view = View::factory('articles/view');

        // Get id of article
        $this->article_id = $this->request->param('id');

        // Get model of article
        $article = ORM::factory('article');

        // Check that id isn't exists
        if ( ! $this->article_id)
        {
            // Get article with largest id
            $article
                ->order_by('id', 'DESC')
                ->find();

            // Set article_id variable
            $this->article_id = $article->id;
        }
        else
        {
            // Get article with given id
            $article
                ->where('id', '=', $this->article_id)
                ->find();
        }

        $view->set('article', $article);

        $this->content->article = $view;
    }

    public function action_favorite()
    {
        // Get id of article
        $this->article_id = $this->request->param('id');

//        var_dump($this->user->id, $this->article_id);

        // Get model of article with given id
        $model = ORM::factory('Users_Article')
            ->where('user_id', '=', $this->user->id)
            ->where('article_id', '=', $this->article_id)
            ->find();

//        var_dump($model);
//        var_dump($model->user_id);
//        var_dump($model->article_id);

//        var_dump($model->loaded());exit;

        if ($model->loaded())
        {
            // Если модель загружена, то удалить запись из таблицы
            $model->delete();
        }
        else
        {
            // Если модель не загружена, то добавить запись в таблицу
            $model
                ->values(array(
                    'user_id'    => $this->user->id,
                    'article_id' => $this->article_id,
                ))
                ->save();
        }

        $this->redirect(URL::get_default_url('articles', '', $this->article_id));
    }

} // End Articles