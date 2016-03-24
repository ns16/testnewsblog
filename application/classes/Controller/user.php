<?php defined('SYSPATH') or die('No direct script access.');

class Controller_User extends Controller_Body {

    public function action_form()
    {
        $errors = array();

        $view = View::factory('user/form');

        // Get id of user
        $id = $this->request->param('id');

        // Get model of user with given id
        $model = ORM::factory('user', $id);

        // If id is exists, and user with this id isn't exists
        if ($id AND ! $model->loaded())
        {
            throw new HTTP_Exception_404;
        }

        // Get values of POST array
        $post = $this->request->post();

        // Get username and email from post
        $username = Arr::get($post, 'username');
        $email = Arr::get($post, 'email');

        // Check that HTTP method is POST
        if (Request::POST == $this->request->method())
        {
            // Create object of Validation class
            $validation = Validation::factory($post);

            // Set labels for fields
            $validation
                ->label('username', 'Имя пользователя')
                ->label('email', 'E-mail')
                ->label('password', 'Пароль')
                ->label('password_confirm', 'Подтверждение пароля')
                ->label('captcha', 'Капча');

            // Create validation rules
            $validation
                ->rule(TRUE, 'not_empty')
                ->rule('username', 'max_length', array(':value', 32))
                ->rule('email', 'email')
                ->rule('email', 'max_length', array(':value', 254))
                ->rule('password', 'matches', array(':validation', ':field', 'password_confirm'))
                ->rule('password', 'min_length', array(':value', 3))
                ->rule('password', 'max_length', array(':value', 64))
                ->rule('captcha', 'captcha');

            // Check that validation rules are made
            if ($validation->check())
            {
                try
                {
                    // Compose list of required fields
                    $expected = array(
                        'username',
                        'email',
                        'password',
                    );

                    // Check that model isn't loaded
                    if ( ! $model->loaded())
                    {
                        // Create new user and set login role
                        $model->create_user($post, $expected);
                        $model->add('roles', ORM::factory('role', array(
                            'name' => 'login',
                        )));
                    }
                    else
                    {
                        throw new HTTP_Exception_404;
                    }

                    // Login new user
                    Auth::instance()->login(
                        $post['username'],
                        $post['password']
                    );

                    // Redirect to view articles page
                    $this->redirect(URL::get_default_url('articles'));
                }
                catch (ORM_Validation_Exception $e)
                {
                    // If the user entered the wrong username or password, then
                    // set message error
                    $errors = $e->errors($e->alias());
                }
            }
            else
            {
                // If the user entered invalid data, then get messages about
                // errors
                $errors = $validation->errors('validation');
            }
        }

        $view->set(array(
            'errors'   => $errors,
            'username' => $username,
            'email'    => $email,
        ));

        $styles = array(
            'media/css/style.css',
            'media/css/login.css',
        );

        $this->template->title = 'Регистрация';
        $this->template->styles = $styles;
        $this->body->container = $view;
    }

} // End User