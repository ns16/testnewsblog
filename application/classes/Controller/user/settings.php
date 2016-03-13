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
            // Add element with 'user_id' key into post array
            $post['user_id'] = $this->user_id;

            // Delete elements with keys of 'year', 'month' and 'day' of post
            // array
            unset($post['year'], $post['month'], $post['day']);

            // Get names of all fields
            $expected = array_keys($model->user_personal->labels());

            // Set values for fields
            $model->user_personal->values($post, $expected);

            try
            {
                // Save changes
                $model->user_personal->save();

                // Redirect to page of personal data
                $this->redirect(URL::get_user_default_url(
                    'settings',
                    'personal',
                    $this->user_id
                ));
            }
            catch (ORM_Validation_Exception $e)
            {
                // Get messages about errors
                $errors = $e->errors($e->alias());
            }
        }

        // Create lists of years, months and days
        $years  = Date::years(1900, 2050);
        $months = Date::rus_months();
        $days   = Date::days(1);

        // Create list of sexes
        $sexes = Model_User_Personal::get_sexes();

        // Get personal date of user as array
        $settings = $model->user_personal->as_array();

        // If element of settings array with 'birthdate' key is defined
        if ($settings['birthdate'])
        {
            $birthdate = array_combine(array('year', 'month', 'day'), explode('-', $settings['birthdate']));

            // Add elements with keys of 'year', 'month' and 'day' into settings
            // array
            $settings = Arr::merge($settings, $birthdate);
        }

        // If post array is defined
        if ($post)
        {
            // Merge settings array by post array
            $settings = Arr::merge($settings, $post);
        }

        $view->set(array(
            'years'    => $years,
            'months'   => $months,
            'days'     => $days,
            'sexes'    => $sexes,
            'settings' => $settings,
            'errors'   => $errors,
            'user_id'  => $this->user_id,
        ));

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
                ->rule('password', 'matches', array(
                    ':validation',
                    ':field',
                    'password_confirm',
                ))
                ->rule('password', 'min_length', array(':value', 3))
                ->rule('password', 'max_length', array(':value', 64));

            // Check that validation rules are made
            if ($result['check'] AND $validation->check())
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
                    $this->redirect(URL::get_user_default_url(
                        'settings',
                        'account',
                        $this->user_id
                    ));
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

            // Merge arrays of errors
            $errors = Arr::merge($errors, $result['errors']);
        }

        $settings = $model->as_array();

        // If post array is defined
        if ($post)
        {
            // Overwrite settings array by post array
            $settings = Arr::overwrite($settings, $post);
        }

        $view->set(array(
            'settings' => $settings,
            'errors'   => $errors,
            'user_id'  => $this->user_id,
        ));

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
            // Add element with 'user_id' key into post array
            $post['user_id'] = $this->user_id;

            // Get names of all fields
            $expected = array_keys($model->user_social->labels());

            // Set values for fields
            $model->user_social->values($post, $expected);

            try
            {
                // Save changes
                $model->user_social->save();

                // Redirect to page of data of social networks
                $this->redirect(URL::get_user_default_url(
                    'settings',
                    'social',
                    $this->user_id
                ));
            }
            catch (ORM_Validation_Exception $e)
            {
                // Get messages about errors
                $errors = $e->errors($e->alias());
            }
        }

        // Get data of social networks of user as array
        $settings = $model->user_social->as_array();

        // If post array is defined
        if ($post)
        {
            // Merge settings array by post array
            $settings = Arr::merge($settings, $post);
        }

        $view->set(array(
            'settings' => $settings,
            'errors'   => $errors,
            'user_id'  => $this->user_id,
        ));

        $this->container->content = $view;
    }

} // End User_Settings