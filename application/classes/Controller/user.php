<?php defined('SYSPATH') or die('No direct script access.');

class Controller_User extends Controller_Body {

    public function action_form()
    {
        $message = '';
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

        // Check that HTTP method is POST
        if (HTTP_Request::POST == $this->request->method())
        {
            // Create object of Validation class
            $validation = Validation::factory($this->request->post());

            // Set labels for fields
            $validation
                ->label('username', 'Имя')
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
                ->rule('password', 'matches',
                    array(
                        ':data',
                        ':field',
                        'password_confirm',
                    )
                )
                ->rule('password', 'max_length', array(':value', 64))
                ->rule('captcha', 'captcha');

            // Check that validation rules are made
            if ($validation->check())
            {
                try
                {
                    // Get values from POST array
                    $post = $this->request->post();

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
                        // Create new user and set login role
                        $model->create_user($post, $expected);
                        $model->add('roles', ORM::factory('role',
                            array(
                                'name' => 'login',
                            )
                        ));
                    }

                    // Redirect to view articles page
                    $this->redirect(URL::site('articles'));
                }
                catch (ORM_Validation_Exception $e)
                {
                    //
                    $message = 'Ошибка регистрации!';
                    // Get messages about errors
                    $errors = $e->errors('model');
                }
            }
            else
            {
                // Get messages about errors
                $errors = $validation->errors('validation');
            }
        }

        // Get arithmetic task
        $task = Captcha::arithmetic_task();

        $view
            ->set('message', $message)
            ->set('errors', $errors)
            ->set('task', $task);

        $links = array(
            'media/css/style.css',
            'media/css/login.css',
        );

        $this->template->title = 'Регистрация';
        $this->template->links = $links;
        $this->body->container = $view;
    }

} // End User