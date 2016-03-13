<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Articles extends Controller_Content {

    public function action_index()
    {
        $user = ORM::factory('User', 1);

        $comments = $user->comments;
        $votes    = $comments->votes;

        echo '<p>Оставленные комментарии: '.$comments->find_all()->count().'</p>';
        echo '<p>Полученные голоса: '.$votes->find_all()->count().'</p>';


        $comments = ORM::factory('Article_Comment')
            ->where('user_id', '=', 1);
        $votes    = $comments->votes;

        var_dump($votes->find_all());

        foreach ($votes->find_all() as $vote) {
            echo $vote->id.'<br>';
        }

        echo '<p>Оставленные комментарии: '.$comments->find_all()->count().'</p>';
        echo '<p>Полученные голоса: '.$votes->find_all()->count().'</p>';


        exit;

        $view = View::factory('articles/index');

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

} // End Articles