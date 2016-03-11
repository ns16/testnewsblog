<?php defined('SYSPATH') or die('No direct script access.');

class Controller_User_Settings extends Controller_User_Base {

    /**
     * @var  View  page template
     */
    public $container;

    public function before()
    {
        $this->user_id = $this->request->param('id');

        parent::before();

        $this->container = View::factory('user/settings')
            ->set('user_id', $this->user_id);

        $links = array(
            'media/css/style.css',
            'media/css/settings.css',
        );

        $this->template->title = 'Мои настройки';
        $this->template->links = $links;
        $this->body->container = $this->container;
    }

    public function action_personal()
    {
        $post = NULL;
        $errors = array();

        $view = View::factory('user/settings/personal');

        // Get model of user with given id
        $model = ORM::factory('user', $this->user_id);

        // If id is exists, and user with this id isn't exists
        if ($this->user_id AND ! $model->loaded())
        {
            throw new HTTP_Exception_404;
        }

        // Check that HTTP method is POST
        if (HTTP_Request::POST == $this->request->method())
        {
            // Get values from POST array
            $post = $this->request->post();

            // Add element with 'birthdate' key into post array
            $birthdate = $post['year'].'-'.$post['month'].'-'.$post['day'];
            $post['birthdate'] = $birthdate;

            // Create object of Validation class
            $validation = Validation::factory($post);

            // Set labels for fields
            $validation
                ->label('name', 'Имя пользователя')
                ->label('birthdate', 'Дата рождения')
                ->label('sex', 'Пол')
                ->label('city', 'Город')
                ->label('activity', 'Деятельность')
                ->label('about_me', 'О себе');

            // Create validation rules
            $validation
                ->rule('name', 'max_length', array(':value', 50))
                ->rule('birthdate', 'date')
                ->rule('sex', 'regex', array(':value', '/^[012]$/'))
                ->rule('city', 'max_length', array(':value', 50))
                ->rule('activity', 'max_length', array(':value', 255));

            // Check that validation rules are made
            if ($validation->check())
            {
                try
                {
                    $model->user_personal->values(
                        array(
                            'name'      => $post['name'],
                            'birthdate' => $post['birthdate'],
                            'sex'       => $post['sex'],
                            'city'      => $post['city'],
                            'activity'  => $post['activity'],
                            'about_me'  => $post['about_me'],
                        )
                    );

                    // Check that model of personal data of user is loaded
                    if ($model->user_personal->loaded())
                    {
                        // Update personal data of user
                        $model->user_personal->update();
                    }
                    else
                    {
                        // Create new personal data of user
                        $model->user_personal
                            ->set('user_id', $this->user_id)
                            ->create();
                    }

                    // Redirect to page of personal data
                    $this->redirect('user/settings/personal/'.$this->user_id);
                }
                catch (ORM_Validation_Exception $e)
                {
                    // Get messages about errors
                    $errors = $e->errors($e->alias());
                }
            }
            else
            {
                // Get messages about errors
                $errors = $validation->errors('validation');
            }
        }

        // Create lists of years, months and days
        $years  = Date::years(1900, 2050);
        $months = Date::rus_months();
        $days   = Date::days(1);

        // Create list of sexes
        $sexes = array(
            1 => 'Мужской',
            2 => 'Женский',
        );

        // Get personal date of user as array
        $settings = $model->user_personal->as_array();

        // If element of settings array with 'birthdate' key is defined
        if ($settings['birthdate'])
        {
            $birthdate = array_combine(
                array(
                    'year',
                    'month',
                    'day',
                ),
                explode('-', $settings['birthdate'])
            );

            // Add elements with keys of 'year', 'month' and 'day' into settings
            // array
            $settings = Arr::merge($settings, $birthdate);
        }

        // If post array is defined
        if ($post)
        {
            // Overwrite settings array by post array
            $settings = Arr::merge($settings, $post);
        }

        $view
            ->set('years', $years)
            ->set('months', $months)
            ->set('days', $days)
            ->set('sexes', $sexes)
            ->set('settings', $settings)
            ->set('errors', $errors)
            ->set('user_id', $this->user_id);

        $this->container->content = $view;
    }

    public function action_account()
    {
        $post = NULL;
        $errors = array();

        $view = View::factory('user/settings/account');

        // Get model of user with given id
        $model = ORM::factory('user', $this->user_id);

        // If id is exists, and user with this id isn't exists
        if ($this->user_id AND ! $model->loaded())
        {
            throw new HTTP_Exception_404;
        }

        // Check that HTTP method is POST
        if (HTTP_Request::POST == $this->request->method())
        {
            $result = Files::upload($this->user_id);

            // Get values from POST array
            $post = $this->request->post();

            // Create object of Validation class
            $validation = Validation::factory($post);

            // Set labels for fields
            $validation
                ->label('username', 'Имя пользователя')
                ->label('email', 'E-mail')
                ->label('password', 'Пароль')
                ->label('password_confirm', 'Подтверждение пароля');

            // Create validation rules
            $validation
                ->rule('username', 'not_empty')
                ->rule('username', 'max_length', array(':value', 32))
                ->rule('email', 'not_empty')
                ->rule('email', 'email')
                ->rule('email', 'max_length', array(':value', 254))
                ->rule('password', 'matches',
                    array(
                        ':data',
                        ':field',
                        'password_confirm',
                    )
                )
                ->rule('password', 'max_length', array(':value', 64));

            // Check that validation rules are made
            if ($result['path'] AND $validation->check())
            {
                try
                {
                    // Compose list of required fields
                    $expected = array(
                        'username',
                        'email',
                        'password',
                    );

                    // Check that model is loaded
                    if ($model->loaded())
                    {
                        // Update data of user
                        $model->update_user($post, $expected);
                    }
                    else
                    {
                        throw new HTTP_Exception_404;
                    }

                    // Redirect to page of account data
                    $this->redirect('user/settings/account/'.$this->user_id);
                }
                catch (ORM_Validation_Exception $e)
                {
                    // Get messages about errors
                    $errors = $e->errors($e->alias());
                }
            }
            else
            {
                // Get messages about errors
                $errors = $validation->errors('validation');
            }

            $errors = Arr::merge($errors, $result['errors']);
        }

        $settings = $model->as_array();

        // If post array is defined
        if ($post)
        {
            // Overwrite settings array by post array
            $settings = Arr::overwrite($settings, $post);
        }

        $view
            ->set('settings', $settings)
            ->set('errors', $errors)
            ->set('user_id', $this->user_id);

        $this->container->content = $view;
    }

    public function action_social()
    {
        $post = NULL;
        $errors = array();

        $view = View::factory('user/settings/social');

        // Get model of user with given id
        $model = ORM::factory('user', $this->user_id);

        // If id is exists, and user with this id isn't exists
        if ($this->user_id AND ! $model->loaded())
        {
            throw new HTTP_Exception_404;
        }

        // Check that HTTP method is POST
        if (HTTP_Request::POST == $this->request->method())
        {
            // Get values from POST array
            $post = $this->request->post();
            $post['user_id'] = $this->user_id;

            $expected = array_keys($model->user_social->labels());

            $model->user_social->values($post, $expected);

            // Create object of Validation class
//            $validation = Validation::factory($post);
//
//            // Set labels for fields
//            $validation
//                ->label('profile_vk', 'Вконтакте')
//                ->label('profile_fb', 'Facebook')
//                ->label('profile_gp', 'Google+')
//                ->label('profile_tw', 'Twitter')
//                ->label('profile_ok', 'Одноклассники');

            // Create validation rules
//            $validation
//                ->rule(TRUE, 'max_length', array(':value', 255))
//                ->rule('profile_vk', 'Valid::profile_vk')
//                ->rule('profile_fb', 'Valid::profile_fb')
//                ->rule('profile_gp', 'Valid::profile_gp')
//                ->rule('profile_tw', 'Valid::profile_tw')
//                ->rule('profile_ok', 'Valid::profile_ok');

            // Check that validation rules are made
//            if ($validation->check())
//            {
                try
                {
//                    $model->user_social->values(
//                        array(
//                            'profile_vk' => $post['profile_vk'],
//                            'profile_fb' => $post['profile_fb'],
//                            'profile_gp' => $post['profile_gp'],
//                            'profile_tw' => $post['profile_tw'],
//                            'profile_ok' => $post['profile_ok'],
//                        )
//                    );

                    // Check that model of data of social networks of user is
                    // loaded
//                    if ($model->user_social->loaded())
//                    {
//                        // Update data of social networks of user
//                        $model->user_social->update();
//                    }
//                    else
//                    {
//                        // Create new data of social networks of user
//                        $model->user_social
//                            ->set('user_id', $this->user_id)
//                            ->create();
//                    }

                    $model->user_social->save();

                    // Redirect to page of data of social networks
                    $this->redirect(URL::get_user_default_url('settings', 'social', $this->user_id));
//                    $this->redirect('user/settings/social/'.$this->user_id);
                }
                catch (ORM_Validation_Exception $e)
                {
                    // Get messages about errors
                    $errors = $e->errors($e->alias());
                }
//            }
//            else
//            {
//                // Get messages about errors
//                $errors = $validation->errors('validation');
//            }
        }

        // Get data of social networks of user as array
        $settings = $model->user_social->as_array();

        // If post array is defined
        if ($post)
        {
            // Overwrite settings array by post array
            $settings = Arr::merge($settings, $post);
        }

        $view->set(
            array(
                'settings' => $settings,
                'errors'   => $errors,
                'user_id'  => $this->user_id,
            )
        );

//        $view
//            ->set('settings', $settings)
//            ->set('errors', $errors)
//            ->set('user_id', $this->user_id);

        $this->container->content = $view;
    }

} // End User_Settings