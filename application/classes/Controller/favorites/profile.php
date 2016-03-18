<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Favorites_Profile extends Controller_Favorites
{
    /**
     * Данный экшен после добавления статьи в избранное или удаления ее из
     * избранного перенаправляет пользователя с данным идентификатором на страницу
     * просмотра его профиля
     */
    public function action_index()
    {
        $this->toggle();

        $this->redirect(URL::get_user_default_url(
            'profile',
            'index',
            $this->user_id
        ));
    }

} // End Favorites_Profile